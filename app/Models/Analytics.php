<?php

namespace App\Models;

use Illuminate\Support\Carbon;

class Analytics
{
    /**
     * @var Income
     */
    private Income $income;

    /**
     * @var Costs
     */
    private Costs $costs;

    /**
     * @var Carbon
     */
    private Carbon $today;

    /**
     * @var Carbon
     */
    private Carbon $tempDate;

    /**
     * Analytics constructor.
     * Initializes the required variables for the calendar
     */
    public function __construct()
    {
        $this->income = new Income();
        $this->costs = new Costs();
        $this->today = Carbon::today();

    }

}
