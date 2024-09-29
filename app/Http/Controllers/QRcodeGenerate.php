<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRcodeGenerate extends Controller
{
    function qrcode()
    {
        $qrCodes = [];
        $qrCodes['simple'] =
            QrCode::size(100)->generate('https://google.com');
        $qrCodes['changeColor'] =
            QrCode::size(150)->color(255, 0, 0)->generate('https://minhazulmin.github.io/');
        $qrCodes['changeBgColor'] =
            QrCode::size(150)->backgroundColor(255, 0, 0)->generate('https://minhazulmin.github.io/');
        $qrCodes['styleDot'] =
            QrCode::size(150)->style('dot')->generate('https://minhazulmin.github.io/');
        $qrCodes['styleSquare'] = QrCode::size(150)->style('square')->generate('https://minhazulmin.github.io/');
        $qrCodes['styleRound'] = QrCode::size(150)->style('round')->generate('https://minhazulmin.github.io/');

        Storage::disk('local')->put('qrcodes/svg/1.svg', $qrCodes['simple']);
        $contents = Storage::get('qrcodes/svg/1.svg');

        $x = [
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),
            Storage::get('qrcodes/svg/1.svg'),

        ];
        foreach ($x as $contents) {
            echo ($contents);
            echo ('&nbsp');
            // echo ('<hr/>');
        }
        // echo ($contents);
        // return view('qrcode', $qrCodes);
    }
}
