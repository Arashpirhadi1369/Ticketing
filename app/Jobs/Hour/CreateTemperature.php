<?php

namespace App\Jobs\Hour;

use App\Traits\Smsable;
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
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Smsable;

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

            $temperature = strstr($sensorData->Temperature1, '.', true);
            $humidity = strstr($sensorData->Humidity1, '.', true);

            DB::table('temperature_monitorings')->insert([
                'sensor_id'     => $sensor->id,
                'temperature'   => $temperature,
                'humidity'      => $humidity,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            if (($sensor->temperature_max_allowance != null) && ($temperature >= $sensor->temperature_max_allowance)) {
                foreach ($sensor->alarmable_numbers as $numbers) {
                    foreach ($numbers as $number) {
                        $this->sendSms($number, "دمای جاری $temperature بیش از حد مجاز برای دستگاه $sensor->device_name در قسمت $sensor->location");
                    }
                }
            }

            if (($sensor->humidity_max_allowance != null) && ($humidity >= $sensor->humidity_max_allowance)) {
                foreach ($sensor->alarmable_numbers as $numbers) {
                    foreach ($numbers as $number) {
                        $this->sendSms($number, "رطوبت جاری $humidity بیش از حد مجاز برای دستگاه $sensor->device_name در قسمت $sensor->location");
                    }
                }
            }
        }
    }
}
