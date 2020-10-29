<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\Filter;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Get all costs by type
     *
     * @param CostsType $costsType
     * @return object
     */
    public function getCostsByType(CostsType $costsType): object
    {
        if (!empty($costsType->id)) {
            return parent::all()->where('user_id', Auth::id())->where('type' , $costsType->id);
        }
    }

    /**
     * Get all all costs on the specified date
     *
     * @param Carbon $date
     * @return mixed
     */
    public function getCostsByDate(Carbon $date):object
    {
        return parent::select()->orderBy('type', 'asc')->where('user_id', Auth::id())->whereDate('date', $date)->get();
    }

    /**
     * We receive the amount of costs for the specified date
     *
     * @param Carbon $date
     * @return string
     */
    public function getAmountsByDate(Carbon $date):string
    {
        $costsByDate = $this->getCostsByDate($date);
        $amounts = 0;

        foreach ($costsByDate as $cost){
            $amounts += $cost->amount;
        }

        return number_format($amounts, 2, ',', ' ');
    }
}
