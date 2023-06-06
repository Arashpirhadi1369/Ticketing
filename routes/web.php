<?php

use App\Http\Livewire\Sms;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboardlayouts\Dashboard;
use App\Http\Livewire\Users;
use App\Http\Middleware\IsHR;
use App\Http\Middleware\IsIT;

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
    Route::get('/sms', Sms::class)->name('sms')->middleware(IsHR::class);
    Route::get('/users', Users::class)->name('users')->middleware(IsIT::class);
});


require __DIR__ . '/auth.php';
