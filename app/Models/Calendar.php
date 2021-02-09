<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Carbon;

class Calendar
{
    /**
     * @var Carbon
     */
    private Carbon $today;

    /**
     * @var Carbon
     */
    private Carbon $tempDate;

    /**
     * @var Income
     */
    private Income $income;

    /**
     * @var Costs
     */
    private Costs $costs;

    /**
     * @var SettingsUser
     */
    private SettingsUser $settings;

    /**
     * @var int
     */
    private int $dayOfWeek;

    /**
     * @var array
     */
    public array $dayInfo;

    /**
     * Calendar constructor.
     * Initializes the required variables for the calendar
     */
    public function __construct()
    {
        $this->income = new Income();
        $this->costs = new Costs();
        $this->settings = new SettingsUser();
        $this->today = Carbon::today();
        $this->setTempDate();
        $this->setDayOfWeek();
    }

    /**
     * Set the date to create a calendar
     * @param Carbon|object $today
     */
    private function setToday(Carbon $today): void
    {
        $this->today = $today;
    }

    /**
     * Sets temp date
     */
    private function setTempDate(): void
    {
        $this->tempDate = Carbon::create($this->today->year, $this->today->month, 1);
    }

    /**
     * Sets the day of the week
     */
    private function setDayOfWeek(): void
    {
        $this->dayOfWeek = $this->tempDate->dayOfWeek;
    }

    /**
     * Filling the data array to display the calendar
     *
     * @param array $info
     */
    private function setDayInfo(array $info): void
    {
        $this->dayInfo[] = $info;
    }


    /**
     * Move from the current date to the beginning of the week using subDay ().
     * Then we spin each week until the month of the end of the week coincides with the month of the current date
     * We clone the "tempDate" of the date because the object is transmitted by reference
     * and in the array we get the last instance of the object
     *
     * @param Carbon $date
     * @return array
     */
    public function createCalendar(Carbon $date): array
    {
        $this->setToday($date);
        $this->setTempDate();
        $this->setDayOfWeek();
        $settings = $this->settings->getSettingsUser();

        for ($i = 0; $i < $this->dayOfWeek; $i++) {
            $this->tempDate->subDay();
        }

        do {
            for ($i = 0; $i < 7; $i++) {
                $this->setDayInfo([
                    'tempDate' => clone $this->tempDate,
                    'today' => $this->today,
                    'allIncomesByDay' => $this->income->getIncomesTypeByDate($this->tempDate),
                    'allCostsByDay' => $this->costs->getCostsTypeByDate($this->tempDate),
                    'amountsIncomeByDay' => $this->income->getAmountsByDate($this->tempDate),
                    'amountsCostsByDay' => $this->costs->getAmountsByDate($this->tempDate),
                    'nextWeek' => $i,
                    'settings' => $settings
                ]);
                $this->tempDate->addDay();
            }
        } while ($this->tempDate->month === $this->today->month);

        return $this->dayInfo;
    }
}
