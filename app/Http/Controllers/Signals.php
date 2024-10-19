<?php

namespace App\Http\Controllers;

use App\Traits\Smsable;
use Illuminate\Http\Request;

class Signals extends Controller
{
    use Smsable;

    public function index(Request $request)
    {
        $message = $request->ip() . '
         ' . $request->status;

        $this->sendSms('09382056185', $message);
    }
}
