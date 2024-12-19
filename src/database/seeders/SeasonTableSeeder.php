<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seasons = [
            ['name' => '春', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '夏', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '秋', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '冬', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('seasons')->insert($seasons);
    }
    
}