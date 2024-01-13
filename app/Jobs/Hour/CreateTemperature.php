<?php

namespace App\Jobs\Hour;

use Illuminate\Bus\Queueable;
use App\Services\SensorsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateTemperature implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SensorsService $SensorsService)
    {
        $sensors = $SensorsService->getSensors();

        foreach ($sensors as $sensor) {
            $sensorData = $SensorsService->getSensorData($sensor->ip);

            DB::table('temperature_monitorings')->insert([
                'sensor_id'     => $sensor->id,
                'temperature'   => strstr($sensorData->Temperature1, '.', true),
                'humidity'      => strstr($sensorData->Humidity1, '.', true),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
