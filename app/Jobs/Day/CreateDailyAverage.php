<?php

namespace App\Jobs\Day;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use App\Services\SensorsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateDailyAverage implements ShouldQueue
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
        $sensorsAverage = $SensorsService->calculateDailyAverage();

        foreach ($sensorsAverage as $sensorAverage) {
            DB::table('average_temperatures')->insert([
                'sensor_id'             => $sensorAverage['sensor_id'],
                'average_temperature'   => $sensorAverage['temperature'],
                'average_humidity'      => $sensorAverage['humidity'],
                'date'                  => Carbon::yesterday(),
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }
    }
}
