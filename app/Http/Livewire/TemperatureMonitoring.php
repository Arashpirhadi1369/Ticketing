<?php

namespace App\Http\Livewire;

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
use App\Models\TemperatureMonitoring as ModelsTemperatureMonitoring;

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
        'phone'     => null,
    ];

    public $headers = ["device", "sensor", "tempereture", "humidity"];

    public function mount(ModelsTemperatureMonitoring $entity)
    {
        $this->entity = $entity;
    }

    public function render()
    {
        $sensors = Sensor::get();

        foreach ($sensors as $sensor) {

            $response = Http::get("http://$sensor->ip/status.xml");
            $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);

            DB::table('temperature_monitorings')->insert([
                'sensor_id'     => $sensor->id,
                'temperature'   => strstr($xml->Temperature1, '.', true),
                'humidity'      => strstr($xml->Humidity1, '.', true),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }


        dd($xml->Humidity1);
        if ($this->selectAll) {
            $this->selected = $this->usersQuery->pluck('id')->map(fn ($id) => (string) $id);
        }

        return view('livewire.temperature-monitoring', ['entities' => $this->entities]);
    }

    public function getentitiesQueryProperty()
    {
        return ModelsTemperatureMonitoring::query()
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

    // public function exportExcel()
    // {
    //     return Excel::download(new ModelsTemperatureMonitoringsExport(), 'ModelsTemperatureMonitoring.xlsx');
    // }
}
