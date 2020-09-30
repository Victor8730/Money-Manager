<?php

declare(strict_types=1);


namespace App\Models;

use Illuminate\Support\Facades\DB;

class TestModel
{
    public function test()
    {
        return DB::table('test')->get();
    }
}
