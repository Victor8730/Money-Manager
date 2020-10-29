<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use Illuminate\Support\Carbon;


class DashboardController extends Controller
{
    /**
     * object the current calendar
     *
     * @var Calendar|object
     */
    private object $currentCalendar;

    /**
     * DashboardController constructor.
     *
     * Initializes the calendar
     */
    public function __construct(){
        $this->currentCalendar = new Calendar();
    }

    public function index(Request $request)
    {
        $year = $request->route('year') ?? Carbon::now()->format('Y');
        $month = $request->route('month') ?? Carbon::now()->format('m');
        $current = Carbon::now();
        $setToDay = Carbon::createFromDate($year, $month);
        $calendar = $this->currentCalendar->createCalendar($setToDay);

        return view('dashboard', compact('calendar','year','month','current', 'setToDay'));
    }
}
