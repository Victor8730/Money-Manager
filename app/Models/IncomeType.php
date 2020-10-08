<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeType extends Model
{
    use HasFactory;

    /**
     * The name of the table in the database
     * @var string
     */
    protected $table = 'income_type';

    /**
     *  Indicates if the model has update and creation timestamps.
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     * Array of fields from the database
     * @var array|string[]
     */
    protected $fillable = [
        'name',
        'desc',
        'created_at',
        'updated_at'
    ];

    public function getNameType($id){
        return IncomeType::firstWhere('id',$id)->name;
    }
}
