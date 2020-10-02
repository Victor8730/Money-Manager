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

    public $timestamps = true;

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
