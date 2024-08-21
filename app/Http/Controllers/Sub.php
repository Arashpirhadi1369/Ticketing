<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Sub extends Controller
{
    function show($domain, $port, $path, $id)
    {
        $response = Http::get("https://$domain:$port/$path/$id");

        if ($response->status() == 200) {
            $cleans = base64_decode($response->body());
            $newAddress = preg_replace('/185.221.192.114/', "$domain", $cleans);
            $encoded = base64_encode($newAddress);

            return $encoded;
        } else {
            abort(403);
        }
    }
}
