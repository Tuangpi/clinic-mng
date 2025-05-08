<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nationalities = \DB::table('nationalities');
        if ($nationalities->count() == 0) {
            \DB::unprepared(file_get_contents(storage_path('sql/nationalities.sql')));
        }
    }
}
