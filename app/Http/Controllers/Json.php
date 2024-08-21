<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Json extends Controller
{
    function show($id)
    {
        $response = Http::get("https://web.ap70.ir:2087/jjj/$id");

        if ($response->status() == 200) {
            $cleans = json_decode($response);
            $newAddress = "web.ap70.ir";
            $cleans->outbounds[0]->settings->vnext[0]->address = $newAddress;

            return $cleans;
        } else {
            abort(403);
        }
    }
}
