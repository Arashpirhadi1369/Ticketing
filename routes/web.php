<?php

use App\Http\Livewire\Dashboardlayouts\Dashboard;
use App\Http\Livewire\Dashboardlayouts\Demandtypelayouts\Alldemand;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AllDemands;
use App\Http\Controllers\Client\MyDemands;
use App\Http\Controllers\Client\DoneDemands;
use App\Http\Controllers\Admin\ReferredDemands;
use App\Http\Controllers\Client\RejectedDemands;
use App\Http\Controllers\Client\InprogressDemands;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/' ,  Dashboard::class
    )->name('dashboard');

//    Route::get('/', [ AllDemands::class , 'index']);

    Route::resource('referreddemands', ReferredDemands::class);
    Route::resource('mydemands', MyDemands::class);
    Route::resource('inprogressdemands', InprogressDemands::class);
    Route::resource('donedemands', DoneDemands::class);
    Route::resource('rejecteddemands', RejectedDemands::class);
});


require __DIR__ . '/auth.php';
