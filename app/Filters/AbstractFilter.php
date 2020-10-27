<?php

declare(strict_types=1);


namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter
{
    protected object $request;

    protected array $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply filter
     * @param Builder $builder
     * @return object
     */
    public function filter(Builder $builder): object
    {
        foreach ($this->getFilters() as $filter => $value) {
            $this->resolveFilter($filter)->filter($builder, $value);
        }

        return $builder;
    }

    /**
     * Get the filters we need
     * @return array
     */
    protected function getFilters(): array
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }

    /**
     * @param $filter
     * @return object
     */
    protected function resolveFilter($filter): object
    {
        return new $this->filters[$filter];
    }
}
