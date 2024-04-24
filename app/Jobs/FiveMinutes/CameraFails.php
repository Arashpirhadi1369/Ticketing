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
                    'camera_name'           => $camera->camera_name,
                    'location'              => $camera->location,
                    'ip'                    => $camera->ip,
                    'jalalian_date'         => Jalalian::now(),
                    'created_at'            => now(),
                    'updated_at'            => now(),
                ]);

                $todayFails = DB::table('camera_fails')->where('camera_id', $camera->id)->whereDate('created_at', Carbon::today())->orderByDesc('created_at')->get();

                //first notify
                if (
                    count($todayFails) == 2 &&
                    ($todayFails[0]->created_at > now()->subMinutes(5)->format('Y-m-d h:i')) &&
                    (now()->subMinutes(4)->format('Y-m-d h:i') > $todayFails[1]->created_at)
                ) {
                    $this->sendSms('09382056185', "دستگاه $camera->camera_name در قسمت $camera->location با ip $camera->ip از دسترس خارج شده");
                }

                //next fail for same day
                if (count($todayFails) > 2) {
                    if (now()->subMinutes(20) > $todayFails->skip(1)->first()->created_at) {
                        $this->sendSms('09382056185', "دستگاه $camera->camera_name در قسمت $camera->location با ip $camera->ip مجدد از دسترس خارج شده");
                    }
                }
            } else {
                $todayFails = DB::table('camera_fails')->where('camera_id', $camera->id)->whereDate('created_at', Carbon::today())->orderByDesc('created_at')->get();

                //back online
                if (count($todayFails) >= 2) {
                    if (now()->subMinutes(6) < $todayFails->first()->created_at) {
                        $this->sendSms('09382056185', "دستگاه $camera->camera_name در قسمت $camera->location با ip $camera->ip روشن شد");
                    }
                }
            }
        }
    }
}
