<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Json extends Controller
{
    function show($domain, $port, $path, $id)
    {
        $response = Http::get("https://$domain:$port/$path/$id");

        if ($response->status() == 200) {
            $cleans = json_decode($response);
            $newAddress = "$domain";
            $cleans->outbounds[0]->settings->vnext[0]->address = $newAddress;

            return json_encode($cleans, JSON_PRETTY_PRINT);
        } else {
            abort(403);
        }
    }
}
