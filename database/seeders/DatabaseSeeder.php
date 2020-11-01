<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\Settings::factory()->create();
         //\App\Models\User::factory(10)->create();
       //$this->call(SettingsTableSeeder::class);
        $this->call(SettingsUserTableSeeder::class);
    }
}
