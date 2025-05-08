<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = \DB::table('cities');
        if ($cities->count() == 0) {
            \DB::unprepared(file_get_contents(storage_path('sql/cities-sg.sql')));
        }
    }
}
