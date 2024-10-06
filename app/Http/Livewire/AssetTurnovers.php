<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\BulkAction;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Models\AssetTurnover;
use App\Traits\ConvertNumbers;
use App\Traits\ResetSearchFilters;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AssetTurnoversExport;
use App\Traits\AdvanceSearch;

class AssetTurnovers extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, BulkAction, WithPagination, AdvanceSearch;

    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $componentName = "asset-turnovers";

    protected $rules = [
        'entity.name' => 'required|min:1|max:200',
    ];

    public $filter  = 'all';

    public $filters = [
        'all'           => null,
        'description'   => null,
    ];

    public $headers = ["asset_tag", "asset_id", 'unit_id', 'belong_to_user', 'asset_location', 'delivery_date', "conflict", "description", "user_id", "created_at"];

    public $modalFields = ['asset_id'];

    public function mount(AssetTurnover $entity)
    {
        $this->entity = $entity;
    }

    public function render()
    {
        return view('livewire.asset-turnovers', ['entities' => $this->entities]);
    }

    public function getentitiesQueryProperty()
    {
        return AssetTurnover::query()
            ->when(
                $this->filters['all'],
                fn($query, $search) => $query
                    ->where('belong_to_user', 'like', '%' . $search . '%')
                    ->orwhere('unit', 'like', '%' . $search . '%')
            )

            ->when($this->filters['description'], fn($query, $search) => $query->where('description', 'like', '%' . $search . '%'))
            ->orderby($this->sortField, $this->sortDirection);
    }

    public function getentitiesProperty()
    {
        return $this->entitiesQuery->paginate(10);
    }

    // public function store()
    // {
    //     $this->validate();
    //     $this->entity->save();
    //     $this->dispatchBrowserEvent('closeModal');
    //     $this->resetInput();
    // }

    // public function edit(AssetTurnover $entity)
    // {
    //     $this->entity = $entity;
    // }

    // public function destroy()
    // {
    //     $assetturnover = AssetTurnover::find($this->entity->id);
    //     $assetturnover->delete();
    //     $this->resetInput();
    // }

    public function exportExcel()
    {
        return Excel::download(new AssetTurnoversExport(), 'AssetTurnovers.xlsx');
    }
}
