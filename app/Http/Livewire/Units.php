<?php

namespace App\Http\Livewire;

use App\Models\Unit;
use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\BulkAction;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Traits\ConvertNumbers;
use App\Traits\ResetSearchFilters;

class Units extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, BulkAction, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $componentName = "units";

    protected $rules = [
        'entity.name' => 'required|min:1|max:200',
    ];

    public $filter  = 'all';

    public $filters = [
        'all'       => null,
        'name'      => null,
    ];

    public $headers = ["name"];

    public $modalFields = ['name'];

    public function mount(Unit $entity)
    {
        $this->entity = $entity;
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->selected = $this->unitsQuery->pluck('id')->map(fn ($id) => (string) $id);
        }

        return view('livewire.units', ['entities' => $this->entities]);
    }

    public function getentitiesQueryProperty()
    {
        return Unit::query()
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
        $this->entity->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function edit(Unit $entity)
    {
        $this->entity = $entity;
    }

    public function destroy()
    {
        $unit = Unit::find($this->entity->id);
        $unit->delete();
        $this->resetInput();
    }

    // public function exportExcel()
    // {
    //     return Excel::download(new UnitsExport(), 'Units.xlsx');
    // }
}
