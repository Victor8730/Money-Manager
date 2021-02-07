<?php

use App\Http\Controllers\CostsController;
use App\Http\Controllers\CostsTypeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomeTypeController;
use App\Http\Controllers\SettingsUserController;
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
    return view('layouts.home');
});

Route::get('analytics', 'App\Http\Controllers\AnalyticsController@index')->middleware('auth');
Route::get('analytics/data/', 'App\Http\Controllers\AnalyticsController@data')->middleware('auth');
Route::get('dashboard/{year?}/{month?}', 'App\Http\Controllers\DashboardController@index')->middleware('auth');
Route::get('language/{locale}', 'App\Http\Controllers\LocalizationController@index');
Route::get('costs/list/', 'App\Http\Controllers\CostsController@list')->middleware('auth');
Route::get('income/list/', 'App\Http\Controllers\IncomeController@list')->middleware('auth');
Route::resource('costs-type', CostsTypeController::class)->middleware('auth');
Route::resource('costs', CostsController::class)->middleware('auth');
Route::resource('income-type', IncomeTypeController::class)->middleware('auth');
Route::resource('income', IncomeController::class)->middleware('auth');
Route::resource('settings', SettingsUserController::class)->middleware('auth');
