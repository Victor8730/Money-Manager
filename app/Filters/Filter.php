<?php

declare(strict_types=1);


namespace App\Filters;


class Filter extends AbstractFilter
{
    /**
     * Array with filter type
     *
     * @var array|string[]
     */
    protected array $filters = [
        'type' => TypeFilter::class,
        'date' => DateFilter::class
    ];
}
