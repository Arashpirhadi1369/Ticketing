<?php

namespace App\Http\Livewire;

use App\Models\Sms;
use App\Models\Unit;
use App\Models\User;
use App\Models\Course;
use App\Traits\Smsable;
use Livewire\Component;
use App\Traits\Sortable;
use App\Models\CourseUser;
use App\Models\SurveyUser;
use App\Traits\BulkAction;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Traits\ConvertNumbers;
use App\Models\EffectivenessUser;
use App\Traits\ResetSearchFilters;
use App\Exports\CoursesUsersExport;
use Maatwebsite\Excel\Facades\Excel;

class CoursesUsers extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, BulkAction, WithPagination, Smsable;

    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $courses;

    public $users;

    public $units;

    public $editMode;

    public $componentName = "courses-users";

    protected $rules = [
        'entity.course_id'          => 'required',
        'entity.user_id'            => 'required',
        'entity.unit_id'            => 'required',
        'entity.manager_user_id'    => 'required',
        'entity.lecturer'           => 'required',
        'entity.start_date'         => 'required|max:16',
        'entity.end_date'           => 'required|max:16',
    ];

    public $filter  = 'all';

    public $filters = [
        'all'                => null,
        'course_id'          => null,
    ];

    public $headers = ["course_id", "user_id", "unit_id", "manager_user_id", "lecturer", "start_date", "end_date"];

    public $modalFields = ['course_id', "user_id",  "unit_id", "manager_user_id", "lecturer", "start_date", "end_date"];

    public function mount(CourseUser $entity)
    {
        $this->entity  = $entity;
        $this->courses = Course::get();
        $this->users   = User::where('phone', '!=', null)->get();
        $this->units   = Unit::get();
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->selected = $this->coursesQuery->pluck('id')->map(fn($id) => (string) $id);
        }

        return view('livewire.courses-users', ['entities' => $this->entities]);
    }

    public function getentitiesQueryProperty()
    {
        return CourseUser::query()
            ->when(
                $this->filters['all'],
                fn($query, $search) => $query
                    ->where('course_id', 'like', '%' . $search . '%')
                // ->orwhere('duration_hour', 'like', '%' . $search . '%')
            )

            ->when($this->filters['course_id'], fn($query, $search) => $query->where('name', 'like', '%' . $search . '%'))
            // ->when($this->filters['duration_hour'], fn ($query, $search) => $query->where('duration_hour', 'like', '%' . $search . '%'))
            ->orderby($this->sortField, $this->sortDirection);
    }

    public function getentitiesProperty()
    {
        return $this->entitiesQuery->paginate(10);
    }

    public function store()
    {
        $this->validate();

        $this->entity->save();

        $user = $this->entity->user;
        $course = $this->entity->course;
        $date = $this->enTofa($this->entity->start_date);

        if ($this->editMode == false) {
            foreach ($course->survey->questions as $surveyQuestion) {
                SurveyUser::create([
                    'courseuser_id' => $this->entity->id,
                    'user_id'       => $this->entity->user_id,
                    'question_id'   => $surveyQuestion->id,
                    'answer_id'     => null,
                ]);
            }

            foreach ($course->effectiveness->questions as $effectivenessQuestion) {
                EffectivenessUser::create([
                    'courseuser_id' => $this->entity->id,
                    'user_id'       => $this->entity->manager_user_id,
                    'question_id'   => $effectivenessQuestion->id,
                    'answer_id'     => null,
                ]);
            }

            $message = __($user->name) . ' گرامی
دوره آموزشی با عنوان : ' . $course->name . '
در تاریخ : ' . $date . '
برای شما برگزار خواهد شد.';

            $results = $this->sendSms($user->phone, $message);

            foreach ($results as $result) {
                Sms::create(
                    [
                        'sender_user_id'        => auth()->user()->id,
                        'source_number'         => $result->sender,
                        'receiver_user_id'      => $user->id,
                        'destination_number'    => $user->phone,
                        'subject'               => 'دوره آموزشی',
                        'receiver_name'         => $user->name,
                        'message'               => $message,
                        'status'                => $result->status,
                        'cost'                  => $result->cost,
                    ]
                );
            }
        }

        $this->editMode = false;

        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function edit(CourseUser $entity)
    {
        $this->entity = $entity;
        $this->editMode = true;
    }

    public function destroy()
    {
        $CourseUser = CourseUser::find($this->entity->id);
        $CourseUser->delete();
        $this->resetInput();
    }

    public function exportExcel()
    {
        return Excel::download(new CoursesUsersExport(), 'Courses.xlsx');
    }
}
