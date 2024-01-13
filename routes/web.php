<?php

use App\Http\Livewire\Sms;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboardlayouts\Dashboard;
use App\Http\Livewire\Phonebooks;
use App\Http\Livewire\TemperatureMonitoring;
use App\Http\Livewire\Users;

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
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/sms', Sms::class)->name('sms')->middleware('permission:sms-read');
    Route::get('/phonebooks', Phonebooks::class)->name('phonebooks')->middleware('permission:sms-read');
    Route::get('/TemperatureMonitoring', TemperatureMonitoring::class)->name('TemperatureMonitoring')->middleware('permission:TemperatureMonitoring-read');
    Route::get('/users', Users::class)->name('users')->middleware('permission:users-read');
});


require __DIR__ . '/auth.php';
