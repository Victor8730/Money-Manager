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
            'notice' => '',
            'value' => '{"1": "USD","2": "UAH","3": "EUR"}',
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'id' => 2,
            'key' => 'format',
            'name' => 'Number format',
            'notice' => '',
            'value' => '{"1": "English","2": "Francais","3": "Usual"}',
            'created_at' => now(),
        ]);

        DB::table('settings')->insert([
            'id' => 3,
            'key' => 'template',
            'name' => 'Visual skin of the program',
            'notice' => '',
            'value' => '{"1": "White-Gray"}',
            'created_at' => now(),
        ]);
    }
}
