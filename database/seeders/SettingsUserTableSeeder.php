<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings_users')->insert([
            'user_id' => 1,
            'setting_id' => 1,
            'value' => 1,
            'created_at' => now(),
        ]);
    }
}
