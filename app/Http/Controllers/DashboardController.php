<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\Calendar;
use Illuminate\Support\Carbon;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->route('year');
        $month = $request->route('month');
        $setToDay = (!empty($month) && !empty($year)) ? Carbon::createFromDate($year, $month) : Carbon::today();
        $calendar = (new Calendar())->createCalendar($setToDay);
        $url = parse_url(url()->current());
        $domains = $url['host'];

        return view('dashboard', compact('calendar', 'domains'));
    }
}
