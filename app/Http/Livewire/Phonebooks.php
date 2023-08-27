<?php

namespace App\Http\Livewire;

use App\Exports\PhonebooksExport;
use Livewire\Component;
use App\Traits\Sortable;
use App\Models\Phonebook;
use App\Traits\BulkAction;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Traits\ConvertNumbers;
use App\Traits\ResetSearchFilters;
use Maatwebsite\Excel\Facades\Excel;

class Phonebooks extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, BulkAction, WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $componentName = "phonebooks";

    protected $rules = [
        'entity.name' => 'required|min:3|max:200',
        'entity.phone' => 'required|min:11',
    ];

    public $filter  = 'all';

    public $filters = [
        'all'       => null,
        'name'      => null,
        'phone'     => null,
    ];

    public $headers = ["name", "phone"];

    public $modalFields = ['name', 'phone'];

    public $editMode = false;

    public function mount(Phonebook $entity)
    {
        $this->entity = $entity;
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->selected = $this->usersQuery->pluck('id')->map(fn ($id) => (string) $id);
        }

        return view('livewire.phonebooks', ['entities' => $this->entities]);
    }

    public function getentitiesQueryProperty()
    {
        return Phonebook::query()
            ->when($this->filters['all'], fn ($query, $search) => $query
                ->where('name', 'like', '%' . $search . '%')
                ->orwhere('phone', 'like', '%' . $search . '%'))

            ->when($this->filters['name'], fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%'))
            ->when($this->filters['phone'], fn ($query, $search) => $query->where('phone', 'like', '%' . $search . '%'))
            ->orderby($this->sortField, $this->sortDirection);
    }

    public function getentitiesProperty()
    {
        return $this->entitiesQuery->paginate(10);
    }

    public function store()
    {
        $this->validate();

        if ($this->editMode == false) {
            $duplicatelotNumber = Phonebook::where('phone', $this->entity->phone)->first();
            if ($duplicatelotNumber) {
                $this->validate(
                    ['entity.phone' => 'email'],
                    [
                        'entity.phone.email' => 'شماره تماس تکراری است.',
                    ],
                );
            }
        }
        $this->entity->phone = $this->faToen($this->entity->phone);
        $this->entity->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function edit(Phonebook $entity)
    {
        $this->editMode = true;
        $this->entity = $entity;
    }

    public function destroy()
    {
        $user = Phonebook::find($this->entity->id);
        $user->delete();
        $this->resetInput();
    }

    public function exportExcel()
    {
        return Excel::download(new PhonebooksExport(), 'Phonebook.xlsx');
    }
}
