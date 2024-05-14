<?php

namespace App\Http\Livewire;

use App\Models\Unit;
use App\Models\Course;
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

    public $units;

    public $selectedUnit;

    public $componentName = "courses";

    protected $rules = [
        'entity.name' => 'required|min:1|max:200',
        'entity.category_id' => 'required|min:1|max:200000',
        'entity.duration_hour' => 'required|min:1|max:1000',
    ];

    public $filter  = 'all';

    public $filters = [
        'all'       => null,
        'name'      => null,
    ];

    public $headers = ["name", "category_id", "duration_hour"];

    public $modalFields = ['name', "category_id", "duration_hour"];

    public function mount(Course $entity)
    {
        $this->entity = $entity;
        $this->units = Unit::get();
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
            )

            ->when($this->filters['name'], fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%'))
            ->orderby($this->sortField, $this->sortDirection);
    }

    public function getentitiesProperty()
    {
        return $this->entitiesQuery->paginate(10);
    }

    public function store()
    {
        $this->validate();

        $selectedUnits = Unit::whereIn('id', $this->selectedUnit)->get();

        $this->entity->save();

        $this->entity->units()->sync($selectedUnits);

        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function edit(Course $entity)
    {
        $this->entity = $entity;

        $selectedUnits = $this->entity->units;

        $Unit = [];
        foreach ($selectedUnits as $selectedUnit) {
            $Unit[] = $selectedUnit->id;
        }

        $this->selectedUnit = $Unit;
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
