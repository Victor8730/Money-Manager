<?php

declare(strict_types=1);


namespace App\Models;

use Illuminate\Support\Carbon;

class Calendar
{
    private object $today;

    private object $tempDate;

    private int $dayOfWeek;

    public function __construct()
    {
        $this->today = Carbon::today();
        $this->tempDate = Carbon::createFromDate($this->today->year, $this->today->month, 1);
        $this->dayOfWeek = $this->tempDate->dayOfWeek;
    }

    /**
     * @return int
     */
    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }

    /**
     * @return Carbon|object
     */
    public function getToday()
    {
        return $this->today;
    }

    /**
     * @return Carbon|object
     */
    public function getTempDate()
    {
        return $this->tempDate;
    }


    public function createCalendar()
    {
        for ($i = 0; $i < $this->dayOfWeek; $i++) {
            $this->tempDate->subDay();
        }

        $result = '<div class="container-fluid">
    <h4 class="display-4 mb-4 text-center">' . $this->today->format('F Y') . '</h4>
    <div class="row d-none d-sm-flex p-1 bg-dark text-white">
      <h5 class="col-sm p-1 text-center">Sunday</h5>
      <h5 class="col-sm p-1 text-center">Monday</h5>
      <h5 class="col-sm p-1 text-center">Tuesday</h5>
      <h5 class="col-sm p-1 text-center">Wednesday</h5>
      <h5 class="col-sm p-1 text-center">Thursday</h5>
      <h5 class="col-sm p-1 text-center">Friday</h5>
      <h5 class="col-sm p-1 text-center">Saturday</h5>
    </div>
    <div class="row border border-right-0 border-bottom-0">';

        do {
            for ($i = 0; $i < 7; $i++) {
                $result .= '<div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate"><h5 class="row align-items-center">';
                $result .= '<span class="date col-1">' . $this->tempDate->day . '</span>';
                $result .= '<small class="col d-sm-none text-center text-muted">' . $this->today->format('l') . '</small>';
                $result .= '<span class="col-1"></span></h5><p class="d-sm-none">No events</p></div>';
                $this->tempDate->addDay();
            }
            $result .='<div class="w-100"></div>';



        } while ($this->tempDate->month == $this->today->month);

        $result .= '</div></div>';

        return $result;
    }
}
