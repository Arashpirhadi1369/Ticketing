<?php

namespace App\Http\Livewire;

use App\Models\AverageTemperature;
use App\Models\Sensor;
use GuzzleHttp\Client;
use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\BulkAction;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Traits\ConvertNumbers;
use App\Traits\ResetSearchFilters;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TemperatureMonitoring extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, BulkAction, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $componentName = "TemperatureMonitoring";

    public $filter  = 'all';

    public $filters = [
        'all'       => null,
        'name'      => null,
        'date'     => null,
    ];

    public $headers = ["device", "sensor", "location", "ip", "average_temperature", "average_humidity", "date"];

    public $modalFields = ['subject', 'phonebook', 'message'];

    public function mount(AverageTemperature $entity)
    {
        $this->entity = $entity;
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->selected = $this->usersQuery->pluck('id')->map(fn ($id) => (string) $id);
        }

        return view('livewire.temperature-monitoring', ['entities' => $this->entities]);
    }

    public function getentitiesQueryProperty()
    {
        return AverageTemperature::query()
            ->when($this->filters['all'], fn ($query, $search) => $query
                ->where('name', 'like', '%' . $search . '%')
                ->orwhere('phone', 'like', '%' . $search . '%'))

            ->when($this->filters['name'], fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%'))
            ->when($this->filters['date'], fn ($query, $search) => $query->where('phone', 'like', '%' . $search . '%'))
            ->orderby($this->sortField, $this->sortDirection);
    }

    public function getentitiesProperty()
    {
        return $this->entitiesQuery->paginate(10);
    }

    // public function exportExcel()
    // {
    //     return Excel::download(new ModelsTemperatureMonitoringsExport(), 'ModelsTemperatureMonitoring.xlsx');
    // }
}
