<?php

namespace App\Traits;

use Kavenegar;

trait Smsable
{
    public function sendSms($receptor, $message)
    {
        try {
            $sender = env('KAVENEGAR_SENDER_NUMBER');        //This is the Sender number

            if (!$sender) {
                abort(403, 'sender number is not avalable.');
            }

            $receptor = [$receptor];                         //Receptors numbers

            $result = Kavenegar::Send($sender, $receptor, $message);
            if ($result) {
                return $result;
            }
        } catch (\Kavenegar\Exceptions\ApiException $e) {
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            echo $e->errorMessage();
        } catch (\Kavenegar\Exceptions\HttpException $e) {
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            echo $e->errorMessage();
        }
    }
}
