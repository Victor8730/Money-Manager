<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\Filter;
use Illuminate\Support\Facades\Auth;

class Income extends Model
{
    use HasFactory;

    /**
     * The name of the table in the database
     * @var string
     */
    protected $table = 'income';

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
        'amount',
        'desc',
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

    /**
     * Get all incomes by type
     *
     * @param IncomeType $incomeType
     * @return object
     */
    public function getIncomesByType(IncomeType $incomeType): object
    {
        if (!empty($incomeType->id)) {
            return parent::all()->where('user_id', Auth::id())->where('type' , $incomeType->id);
        }
    }
}
