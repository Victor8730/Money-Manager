<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Carbon;

class Calendar
{
    private Carbon $today;

    private Carbon $tempDate;

    private Income $income;

    private Costs $costs;

    private SettingsUser $settings;

    private int $dayOfWeek;

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
    private function setDayInfo(array $info)
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
    public function createCalendar(Carbon $date)
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
                    'amountsIncomeByDay' => $this->income->getAmountsByDate($this->tempDate, $settings['format']['value']),
                    'amountsCostsByDay' => $this->costs->getAmountsByDate($this->tempDate, $settings['format']['value']),
                    'nextWeek' => $i,
                    'settings' => $settings
                ]);
                $this->tempDate->addDay();
            }
        } while ($this->tempDate->month === $this->today->month);

        return $this->dayInfo;
    }
}
