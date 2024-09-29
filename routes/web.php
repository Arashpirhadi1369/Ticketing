<?php

use App\Http\Controllers\AssetTurnoversController;
use App\Http\Controllers\Json;
use App\Http\Controllers\QRcodeGenerate;
use App\Http\Controllers\Sub;
use App\Http\Livewire\Assets;
use App\Http\Livewire\AssetTurnovers;
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
use App\Http\Livewire\UserLogs;
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
    Route::get('/assets', Assets::class)->name('assets')->middleware('permission:assets-read');
    Route::get('/asset-turnovers', AssetTurnovers::class)->name('asset-turnovers')->middleware('permission:asset-turnovers-read');
    Route::get('/turnovers/create/{id}', [AssetTurnoversController::class, 'create'])->middleware('permission:asset-turnovers-create');
    Route::post('/turnovers/store', [AssetTurnoversController::class, 'store'])->name('turnovers/store')->middleware('permission:asset-turnovers-create');
    Route::get('/userlogs', UserLogs::class)->name('userlogs')->middleware('permission:userlogs-read');
});

Route::get('/sss/{domain}/{port}/{path}/{id}', [Sub::class, 'show'])->name('sub');
Route::get('/jjj/{domain}/{port}/{path}/{id}', [Json::class, 'show'])->name('json');

Route::get('/qrcode', [QRcodeGenerate::class, 'qrcode']);

require __DIR__ . '/auth.php';
