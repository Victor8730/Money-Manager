<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder  extends Seeder
{
    public function run()
    {
        DB::table('settings')->insert([
            'id' => 1,
            'key' => 'currency',
            'name' => 'Currency',
            'value' => 'UAH',
            'created_at' => now(),
        ]);
    }
}
