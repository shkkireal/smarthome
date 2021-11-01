<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/device', ['as' => 'driver', 'uses' => 'App\Http\Controllers\DriverController@box_reqest'])->name('device');
Route::get('/monitoring', ['as' => 'sireal', 'uses' => 'App\Http\Controllers\MonitoringController@pushTemp'])->name('monitoring');


