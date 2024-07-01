<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Course;
use App\Models\Effectiveness;
use App\Models\Survey;
use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\BulkAction;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Traits\ConvertNumbers;
use App\Traits\ResetSearchFilters;

class Courses extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, BulkAction, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $categories;

    public $surveys;

    public $effectivenesses;

    public $componentName = "courses";

    protected $rules = [
        'entity.name' => 'required|min:1|max:200',
        'entity.duration_hour' => 'required|numeric|min:1|max:1000',
        'entity.category_id' => 'required|min:1|max:200000',
        'entity.survey_id' => 'required|min:1|max:1000',
        'entity.effectiveness_id' => 'required|min:1|max:200000',
    ];

    public $filter  = 'all';

    public $filters = [
        'all'                => null,
        'name'               => null,
        'duration_hour'      => null,
    ];

    public $headers = ["name", "duration_hour", "category_id", 'survey_id', 'effectiveness_id'];

    public $modalFields = ['name', "duration_hour",  "category_id", 'survey_id', 'effectiveness_id'];

    public function mount(Course $entity)
    {
        $this->entity = $entity;
        $this->categories = Category::get();
        $this->surveys = Survey::get();
        $this->effectivenesses = Effectiveness::get();
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->selected = $this->coursesQuery->pluck('id')->map(fn ($id) => (string) $id);
        }

        return view('livewire.courses', ['entities' => $this->entities]);
    }

    public function getentitiesQueryProperty()
    {
        return Course::query()
            ->when(
                $this->filters['all'],
                fn ($query, $search) => $query
                    ->where('name', 'like', '%' . $search . '%')
                    ->orwhere('duration_hour', 'like', '%' . $search . '%')
            )

            ->when($this->filters['name'], fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%'))
            ->when($this->filters['duration_hour'], fn ($query, $search) => $query->where('duration_hour', 'like', '%' . $search . '%'))
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

        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function edit(Course $entity)
    {
        $this->entity = $entity;
    }

    public function destroy()
    {
        $course = Course::find($this->entity->id);
        $course->delete();
        $this->resetInput();
    }

    // public function exportExcel()
    // {
    //     return Excel::download(new CoursesExport(), 'Courses.xlsx');
    // }
}
