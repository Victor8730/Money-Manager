<?php

use App\Http\Controllers\CostsController;
use App\Http\Controllers\CostsTypeController;
use App\Http\Controllers\DashboardController    ;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomeTypeController;
use App\Models\Calendar;
use Illuminate\Support\Carbon;
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


/*$event = '<a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-danger text-white" title="Test Event 3">Test Event 3</a>';

$setToDay = Carbon::today();
$calendar = (new Calendar())->createCalendar($setToDay);
$url = parse_url(url()->current());


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () use ($calendar,$url) {
    return view('dashboard', compact('calendar', 'url'));
})->name('dashboard');*/

/*Route::get('dashboard/{year?}/{month?}', function ($idYear = null, $idMonth = null) use ($domains) {
    return view('dashboard', compact('idYear', 'idMonth', 'domains'));
})->middleware('auth');*/

//Route::get('dashboard/{year?}/{month?}', [DashboardController::class ,'index'])->middleware('auth');


Route::get('dashboard/{year?}/{month?}', 'App\Http\Controllers\DashboardController@index')->middleware('auth');
Route::resource('costs-type', CostsTypeController::class)->middleware('auth');
Route::resource('costs', CostsController::class)->middleware('auth');
Route::resource('income-type', IncomeTypeController::class)->middleware('auth');
Route::resource('income', IncomeController::class)->middleware('auth');
