<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Carbon;

class Calendar
{
    private object $today;

    private object $tempDate;

    private int $dayOfWeek;

    /**
     * Calendar constructor.
     * Initializes the required variables for the calendar
     */
    public function __construct()
    {
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
        $this->tempDate = Carbon::createFromDate($this->today->year, $this->today->month, 1);
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
        $day = '';

        for ($i = 0; $i < $this->dayOfWeek; $i++) {
            $this->tempDate->subDay();
        }

        do {
            for ($i = 0; $i < 7; $i++) {
                $incomeData = Income::whereYear('date', $this->tempDate->year)
                    ->whereMonth('date', $this->tempDate->month)
                    ->whereDay('date', $this->tempDate->day)
                    ->get();
                $costsType = CostsType::all('name', 'id');
                $costsData = Costs::whereYear('date', $this->tempDate->year)
                    ->whereMonth('date', $this->tempDate->month)
                    ->whereDay('date', $this->tempDate->day)
                    ->get();
                $day .= view('calendar.day', [
                    'tempDate' => $this->tempDate,
                    'today' => $this->today,
                    'incomeData' => $incomeData,
                    'costsData' => $costsData,
                    'costsType' => $costsType,
                    'nextWeek' => $i
                ]);
                $this->tempDate->addDay();
            }

        } while ($this->tempDate->month === $this->today->month);

        return view('calendar.month', compact('day'));
    }
}
