<?php

use App\Http\Controllers\Admin\AllDemands;
use App\Http\Controllers\Admin\RefrredTickets;
use App\Http\Controllers\Client\Done;
use App\Http\Controllers\Client\Open;
use App\Http\Controllers\Client\Rejected;
use App\Http\Controllers\Client\Todo;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('alldemands', AllDemands::class);
Route::resource('refrredtickets', RefrredTickets::class);
Route::resource('open', Open::class);
Route::resource('todo', Todo::class);
Route::resource('done', Done::class);
Route::resource('rejected', Rejected::class);

//Route::get('/ticketdashboard', function () {
//    return view('ticketdashboard.adminpanel');
//});

//Route::group(['middleware' => 'firewall.all'], function () {
//
//    Route::get('/', function () {
//        return view('dashboard');
//    })->middleware(['auth'])->name('dashboard');
//});


require __DIR__ . '/auth.php';
