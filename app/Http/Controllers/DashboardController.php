<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CostsType;
use App\Models\IncomeType;
use Illuminate\Http\Request;
use App\Models\Calendar;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;


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
    public function __construct()
    {
        $this->currentCalendar = new Calendar();
    }

    /**
     * Create calendar
     * Get date from url, if not exist get current date
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $year = $request->route('year') ?? Carbon::now()->format('Y');
        $month = $request->route('month') ?? Carbon::now()->format('m');
        $monthsList = $this->MonthList($year);
        $current = Carbon::now();
        $setToDay = Carbon::createFromDate($year, $month);
        $dayData = $this->currentCalendar->createCalendar($setToDay);
        $maxIncome = $maxCosts = $amountsIncomes = $amountsCosts = 0;
        $allCosts = $allIncomes = [];
        $days = '';

        foreach ($dayData as $day) {
            $days .= view('calendar.day', $day);
            $maxIncome = ($day['amountsIncomeByDay'] > $maxIncome) ? $day['amountsIncomeByDay'] : $maxIncome;
            $maxCosts = ($day['amountsCostsByDay'] > $maxCosts) ? $day['amountsCostsByDay'] : $maxCosts;
            if ($day['tempDate']->month === $day['today']->month) {
                $amountsIncomes += $day['amountsIncomeByDay'];
                $amountsCosts += $day['amountsCostsByDay'];

                foreach ($day['allIncomesByDay'] as $typeIdIncomes => $income) {
                    $allIncomes[$typeIdIncomes]['amount'] = (isset($allIncomes[$typeIdIncomes]['amount'])) ? $allIncomes[$typeIdIncomes]['amount'] + $income['amount'] : $income['amount'];
                    $allIncomes[$typeIdIncomes]['type-name'] = (new IncomeType())->getTypeNameById($typeIdIncomes);
                }

                foreach ($day['allCostsByDay'] as $typeIdCosts => $costs) {
                    $allCosts[$typeIdCosts]['amount'] = (isset($allCosts[$typeIdCosts]['amount'])) ? $allCosts[$typeIdCosts]['amount'] + $costs['amount'] : $costs['amount'];
                    $allCosts[$typeIdCosts]['type-name'] =(new CostsType())->getTypeNameById($typeIdCosts);
                }

            }
        }

        $calendar = view('calendar.month', compact('days'));

        return view('dashboard', compact(
                'calendar',
                'year',
                'month',
                'monthsList',
                'current',
                'setToDay',
                'dayData',
                'maxIncome',
                'maxCosts',
                'amountsIncomes',
                'amountsCosts',
                'allIncomes',
                'allCosts',
            )
        );
    }

    /**
     * Generate list month for foreach in view
     * Used translated format
     *
     * @param $year
     * @return array
     */
    private function MonthList($year)
    {
        $period = CarbonPeriod::create($year . '-01-01', '1 month', $year . '-12-01');
        $months = [];

        foreach ($period as $month) {
            $months[] = $month->translatedFormat('F');
        }

        return $months;
    }
}
