<?php

use App\Http\Livewire\Categories;
use App\Http\Livewire\Courses;
use App\Http\Livewire\CoursesUsers;
use App\Http\Livewire\Sms;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboardlayouts\Dashboard;
use App\Http\Livewire\Effectivenesses;
use App\Http\Livewire\EffectivenessesUser;
use App\Http\Livewire\Phonebooks;
use App\Http\Livewire\Sensors;
use App\Http\Livewire\Surveys;
use App\Http\Livewire\SurveysUser;
use App\Http\Livewire\TemperatureMonitoring;
use App\Http\Livewire\Units;
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
    Route::get('/temperature-monitoring', TemperatureMonitoring::class)->name('temperature-monitoring')->middleware('permission:sensors-read');
    Route::get('/sensors', Sensors::class)->name('sensors')->middleware('permission:sensors-read');
    Route::get('/users', Users::class)->name('users')->middleware('permission:users-read');
    Route::get('/units', Units::class)->name('units')->middleware('permission:units-read');
    Route::get('/categories', Categories::class)->name('categories')->middleware('permission:categories-read');
    Route::get('/surveys', Surveys::class)->name('surveys')->middleware('permission:courses-read');
    Route::get('/effectivenesses', Effectivenesses::class)->name('effectivenesses')->middleware('permission:courses-read');
    Route::get('/courses', Courses::class)->name('courses')->middleware('permission:courses-read');
    Route::get('/courses-users', CoursesUsers::class)->name('courses-users')->middleware('permission:courses-read');
    Route::get('/surveys-user', SurveysUser::class)->name('surveys-user');
    Route::get('/effectivenesses-user', EffectivenessesUser::class)->name('effectivenesses-user');
});


require __DIR__ . '/auth.php';
