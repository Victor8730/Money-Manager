<?php

use App\Http\Controllers\CostsController;
use App\Http\Controllers\CostsTypeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomeTypeController;
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

Route::get('dashboard/{year?}/{month?}', 'App\Http\Controllers\DashboardController@index')->middleware('auth');
Route::resource('costs-type', CostsTypeController::class)->middleware('auth');
Route::resource('costs', CostsController::class)->middleware('auth');
Route::resource('income-type', IncomeTypeController::class)->middleware('auth');
Route::resource('income', IncomeController::class)->middleware('auth');
