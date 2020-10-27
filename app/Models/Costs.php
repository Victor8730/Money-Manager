<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\Filter;

class Costs extends Model
{
    use HasFactory;

    /**
     * The name of the table in the database
     * @var string
     */
    protected $table = 'costs';

    /**
     * Indicates if the model has update and creation timestamps.
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     * Array of fields from the database
     * @var array|string[]
     */
    protected $fillable = [
        'user_id',
        'type',
        'desc',
        'amount',
        'date',
        'created_at',
        'updated_at'
    ];

    /**
     * @param Builder $builder
     * @param $request
     * @return object
     */
    public function scopeFilter(Builder $builder, $request): object
    {
        return (new Filter($request))->filter($builder);
    }
}
