<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Carbon;

class Calendar
{
    private object $today;

    private object $tempDate;

    private object $income;

    private object $costs;

    private $settings;

    private int $dayOfWeek;

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
     * Generating a calendar display
     *
     * @param Carbon $date
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createCalendar(Carbon $date)
    {
        $this->setToday($date);
        $this->setTempDate();
        $this->setDayOfWeek();
        $settings = $this->settings->getSettingsUser();
        $day = '';

        for ($i = 0; $i < $this->dayOfWeek; $i++) {
            $this->tempDate->subDay();
        }

        do {
            for ($i = 0; $i < 7; $i++) {

                $day .= view('calendar.day', [
                    'tempDate' => $this->tempDate,
                    'today' => $this->today,
                    'amountsIncomeByDay' => $this->income->getAmountsByDate($this->tempDate, $settings['format']['value']),
                    'amountsCostsByDay' => $this->costs->getAmountsByDate($this->tempDate, $settings['format']['value']),
                    'nextWeek' => $i,
                    'settings' => $settings
                ]);
                $this->tempDate->addDay();
            }

        } while ($this->tempDate->month === $this->today->month);

        return view('calendar.month', compact('day'));
    }
}
