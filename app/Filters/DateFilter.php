<?php

declare(strict_types=1);


namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

class DateFilter
{
    /**
     * Add a filter to the search query for income and expenses by date
     *
     * @param Builder $builder
     * @param string $value
     * @return Builder
     */
    public function filter(Builder $builder,string $value): Builder
    {
        return $builder->whereDate('date', $value);
    }
}
