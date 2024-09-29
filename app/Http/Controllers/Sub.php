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
            $currentPublicIp = file_get_contents('https://api.ipify.org');
            $cleans = base64_decode($response->body());
            $newAddress = preg_replace("/$currentPublicIp/", "$domain", $cleans);
            $encoded = base64_encode($newAddress);

            return $encoded;
        } else {
            abort(403);
        }
    }
}
