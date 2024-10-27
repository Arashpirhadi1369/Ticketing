<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\Sortable;
use App\Models\CourseUser;
use App\Models\SurveyUser;
use App\Traits\BulkAction;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use Morilog\Jalali\Jalalian;
use App\Traits\ConvertNumbers;
use App\Traits\ResetSearchFilters;
use Illuminate\Support\Facades\Auth;

class SurveysUser extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, BulkAction, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $entity;
    public $userAnswers = [];
    public $questions;
    public $answers;

    public $componentName = "surveys-user";

    protected $rules = [
        'userAnswers.*' => 'required',
    ];

    public $filter  = 'all';

    public $filters = [
        'all'       => null,
        'name'      => null,
    ];

    public $headers = ['course_id', 'start_date', 'end_date', 'user_id', 'unit_id', 'lecturer', 'survey_finished_date'];

    public $modalFields = ['question_id', 'answer_id'];

    public function mount(CourseUser $entity)
    {
        $this->entity = $entity;
    }

    public function render()
    {
        return view('livewire.surveys-user', [
            'entities' => $this->entities,
            'questions' => $this->questions,
        ]);
    }

    public function getentitiesQueryProperty()
    {
        if (Auth::getUser()->hasRole(['administrator', 'qa-manager'])) {
            return CourseUser::query()->when(
                $this->filters['all'],
                fn($query, $search) => $query
                    ->where('course_id', 'like', '%' . $search . '%')
            )

                ->when($this->filters['name'], fn($query, $search) => $query->where('name', 'like', '%' . $search . '%'))
                ->orderby($this->sortField, $this->sortDirection);
        } else {
            return CourseUser::query()->where('user_id', Auth::getUser()->id)
                ->when(
                    $this->filters['all'],
                    fn($query, $search) => $query
                        ->where('course_id', 'like', '%' . $search . '%')
                )

                ->when($this->filters['name'], fn($query, $search) => $query->where('name', 'like', '%' . $search . '%'))
                ->orderby($this->sortField, $this->sortDirection);
        }
    }

    public function getentitiesProperty()
    {
        return $this->entitiesQuery->paginate(10);
    }

    public function store()
    {
        if ($this->entity->survey_finished_date == null) {
            if (count($this->questions) == count($this->userAnswers)) {

                foreach ($this->userAnswers as $key => $value) {
                    SurveyUser::where('id', $this->entity->surveyUser[$key]->id)->update(['answer_id' => $value]);
                }

                CourseUser::where('id', $this->entity->id)->update(['survey_finished_date' => Jalalian::now()->format('Y-m-d')]);
            } else {
                $this->validate(
                    ["userAnswers" => 'email'],
                    [
                        "userAnswers.email" => 'به همه سوالات پاسخ داده نشده است.',
                    ],
                );
            }
        } else {
            $this->validate(
                ["userAnswers" => 'email'],
                [
                    "userAnswers.email" => 'این فرم قبلا تکمیل شده است.',
                ],
            );
        }

        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function edit(CourseUser $entity)
    {
        $this->entity = $entity;

        $this->questions = $this->entity->course->survey->questions;
        $this->answers = $this->entity->course->survey->answers;
    }

    public function destroy()
    {
        if ($this->entity->survey_finished_date == Jalalian::now()->format('Y-m-d')) {
            CourseUser::where('id', $this->entity->id)->update(['survey_finished_date' => null]);

            foreach ($this->entity->surveyUser as $surveyUserQuestion) {
                SurveyUser::where('id', $surveyUserQuestion->id)->update(['answer_id' => null]);
            }

            $this->resetInput();
        }
    }

    // public function exportExcel()
    // {
    //     return Excel::download(new surveysExport(), 'surveys.xlsx');
    // }
}
