<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboardlayouts\Dashboard;
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
    Route::get('/sms', Dashboard::class)->name('sms');
    Route::get('/users', Users::class)->name('users');
});


require __DIR__ . '/auth.php';
