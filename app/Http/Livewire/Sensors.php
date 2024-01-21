<?php

namespace App\Http\Livewire;

use App\Models\Sensor;
use Livewire\Component;
use App\Traits\Sortable;
use App\Models\Phonebook;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Traits\ConvertNumbers;
use App\Traits\ResetSearchFilters;

class Sensors extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $phonebooks;

    public $phones;

    public $infoEntity;

    public $componentName = "sensor";

    protected $rules = [
        'entity.device_name'               => 'required',
        'entity.sensor_name'               => 'required',
        'entity.location'                  => 'required',
        'entity.ip'                        => 'required',
        'entity.temperature_max_allowance' => 'required|int',
        'entity.humidity_max_allowance'    => 'required|int',
        'phones'                           => '',
    ];

    public $filter  = 'all';

    public $filters = [
        'all'                => null,
    ];

    public $headers = ['device_name', 'sensor_name', 'location', 'ip', 'temperature_max_allowance', 'humidity_max_allowance'];

    public $modalFields = ['device_name', 'sensor_name', 'location', 'ip', 'temperature_max_allowance', 'humidity_max_allowance', 'phonebook'];

    public function mount(Sensor $entity)
    {
        $this->entity = $entity;
        $this->infoEntity = $entity;
        $this->phonebooks = Phonebook::get();
    }

    public function render()
    {
        return view('livewire.sensors', ['entities' => $this->entities]);
    }

    public function getentitiesQueryProperty()
    {
        return Sensor::query()
            ->when($this->filters['all'], fn ($query, $search) => $query
                ->where('device_name', 'like', '%' . $search . '%')
                ->orwhere('sensor_name', 'like', '%' . $search . '%')
                ->orwhere('location', 'like', '%' . $search . '%')
                ->orwhere('ip', 'like', '%' . $search . '%')
                ->orwhere('temperature_max_allowance', 'like', '%' . $search . '%')
                ->orwhere('humidity_max_allowance', 'like', '%' . $search . '%'))
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
        $this->entity->phonebooks()->sync($this->phones);

        $this->dispatchBrowserEvent('closeModal');
        $this->emit('stored');
        $this->resetInput();
    }

    public function edit(Sensor $entity)
    {
        $this->entity = $entity;
        $this->infoEntity = $entity;
        $this->phones = $entity->phonebooks;
    }

    public function destroy()
    {
        $user = Sensor::find($this->entity->id);
        $user->delete();
        $this->resetInput();
    }
}
