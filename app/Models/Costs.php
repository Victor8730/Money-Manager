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
        'type_id',
        'desc',
        'amount',
        'date',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(CostsType::class);
    }

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
     * Get all all costs on the specified date
     *
     * @param Carbon $date
     * @return mixed
     */
    public function getCostsByDate(Carbon $date): object
    {
        return $this
            ->select()
            ->orderBy('type_id', 'asc')
            ->where('user_id', Auth::id())
            ->whereDate('date', $date)
            ->get();
    }

    /**
     * We receive the amount of costs for the specified date
     *
     * @param Carbon $date
     * @return string
     */
    public function getAmountsByDate(Carbon $date): string
    {
        return $this->getCostsByDate($date)->sum('amount');
    }
}
