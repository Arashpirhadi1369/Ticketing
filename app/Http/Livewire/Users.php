<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\BulkAction;
use App\Traits\ConvertNumbers;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Traits\ResetSearchFilters;

class Users extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, BulkAction, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $componentName = "users";

    protected $rules = [
        'entity.name' => 'required|min:3|max:200',
        'entity.phone' => '',
    ];

    public $filter  = 'all';

    public $filters = [
        'all'       => null,
        'name'      => null,
        'username'  => null,
        'phone'     => null,
    ];

    public $headers = ["name", "username", "ou", "phone"];

    public function mount(User $entity)
    {
        $this->entity = $entity;
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->selected = $this->usersQuery->pluck('id')->map(fn ($id) => (string) $id);
        }

        return view('livewire.users', ['entities' => $this->entities]);
    }

    public function getentitiesQueryProperty()
    {
        return User::query()
            ->when($this->filters['all'], fn ($query, $search) => $query
                ->where('name', 'like', '%' . $search . '%')
                ->orwhere('username', 'like', '%' . $search . '%'))

            ->when($this->filters['name'], fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%'))
            ->when($this->filters['username'], fn ($query, $search) => $query->where('username', 'like', '%' . $search . '%'))
            ->orderby($this->sortField, $this->sortDirection);
    }

    public function getentitiesProperty()
    {
        return $this->entitiesQuery->paginate(10);
    }

    public function store()
    {
        $this->validate();
        $this->entity->phone = $this->faToen($this->entity->phone);
        $this->entity->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function edit(User $entity)
    {
        $this->entity = $entity;
    }

    public function destroy()
    {
        $user = User::find($this->entity->id);
        $user->delete();
        $this->resetInput();
    }
}
