<?php

namespace App\Jobs\FiveMinutes;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use Illuminate\Bus\Queueable;
use App\Traits\Smsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CameraFails implements ShouldQueue
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
    public function handle()
    {
        $cameras = DB::table('cameras')->get();

        foreach ($cameras as $camera) {
            $ip = $camera->ip;
            $port = '80';
            $url = $ip . ':' . $port;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $health = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if (!$health) {
                DB::table('camera_fails')->insert([
                    'camera_id'             => $camera->id,
                    'jalalian_date'         => Jalalian::now(),
                    'created_at'            => now(),
                    'updated_at'            => now(),
                ]);

                $fails = DB::table('camera_fails')->where('camera_id', $camera->id)->whereDate('created_at', Carbon::today())->get();

                if (count($fails) > 1 && count($fails) < 4) {
                    $this->sendSms('09382056185', "دستگاه $camera->camera_name در قسمت $camera->location با ip $camera->ip از دسترس خارج شده");
                }
            }
        }
    }
}
