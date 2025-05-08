<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = \DB::table('states');
        if ($states->count() == 0) {
            \DB::unprepared(file_get_contents(storage_path('sql/states-sg.sql')));
        }
    }
}
