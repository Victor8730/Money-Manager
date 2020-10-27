<?php

declare(strict_types=1);


namespace App\Filters;


class DateFilter
{
    public function filter($builder, $value)
    {
        return $builder->whereDate('date', $value);
    }
}
