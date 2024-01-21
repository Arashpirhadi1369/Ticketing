<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\BulkAction;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Traits\ConvertNumbers;
use App\Models\AverageTemperature;
use App\Traits\ResetSearchFilters;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TemperatureMonitoringExport;

class TemperatureMonitoring extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, BulkAction, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $componentName = "temperature-monitoring";

    public $filter  = 'all';

    public $filters = [
        'all'              => null,
        'date'             => null,
        'date_greaterThan' => null,
        'date_lessThan'    => null,
    ];

    protected $rules = [
        'entity.date' => 'required',
    ];

    public $headers = ["device", "sensor_id", "location", "ip", "average_temperature", "average_humidity", "date"];

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
                ->where('date', 'like', '%' . $search . '%'))

            ->when($this->filters['date'], fn ($query, $search) => $query->where('date', 'like', '%' . $search . '%'))
            ->when($this->filters['date_greaterThan'], fn ($query, $search) => $query->where('date', '>=',  $search))
            ->when($this->filters['date_lessThan'], fn ($query, $search) => $query->where('date', '<=',  $search))
            ->orderby($this->sortField, $this->sortDirection);
    }

    public function getentitiesProperty()
    {
        return $this->entitiesQuery->paginate(10);
    }

    public function exportExcel()
    {
        return Excel::download(new TemperatureMonitoringExport(), 'TemperatureMonitoring.xlsx');
    }
}
