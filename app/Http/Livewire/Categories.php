<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Traits\Sortable;
use App\Traits\BulkAction;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Traits\ConvertNumbers;
use App\Traits\ResetSearchFilters;

class Categories extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, BulkAction, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $componentName = "categories";

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

    public function mount(Category $entity)
    {
        $this->entity = $entity;
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->selected = $this->categoriesQuery->pluck('id')->map(fn ($id) => (string) $id);
        }

        return view('livewire.categories', ['entities' => $this->entities]);
    }

    public function getentitiesQueryProperty()
    {
        return Category::query()
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

    public function edit(Category $entity)
    {
        $this->entity = $entity;
    }

    public function destroy()
    {
        $categories = Category::find($this->entity->id);
        $categories->delete();
        $this->resetInput();
    }

    // public function exportExcel()
    // {
    //     return Excel::download(new CategorysExport(), 'Categorys.xlsx');
    // }
}
