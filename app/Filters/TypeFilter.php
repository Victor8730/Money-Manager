<?php

declare(strict_types=1);


namespace App\Filters;


class TypeFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('type', $value);
    }
}
