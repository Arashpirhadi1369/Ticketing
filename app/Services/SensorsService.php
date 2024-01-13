<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Sensor;
use Illuminate\Support\Facades\Http;
use App\Models\TemperatureMonitoring;

class SensorsService
{
    public function getSensors()
    {
        return Sensor::get();
    }

    public function getSensorData($ip)
    {
        $response = Http::get("http://$ip/status.xml");
        return simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
    }

    public function calculateDailyAverage(): array
    {
        $sensors = $this->getSensors();

        $sensorsAverage = [];

        foreach ($sensors as $sensor) {
            $dailyRecords = TemperatureMonitoring::where('sensor_id', '=', "$sensor->id")->whereDate('created_at', Carbon::yesterday())->get();
            $temperatureAverage = $dailyRecords->avg('temperature');
            $humidityAverage = $dailyRecords->avg('humidity');
            if ($humidityAverage != null || $temperatureAverage != null) {
                $sensorsAverage[] = ['sensor_id' => $sensor->id, 'temperature' => round($temperatureAverage), 'humidity' => round($humidityAverage)];
            }
        }

        return $sensorsAverage;
    }
}
