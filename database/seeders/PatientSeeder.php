<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = \DB::table('patients');
        if ($patients->count() == 0) {
            \DB::unprepared(file_get_contents(storage_path('sql/patients-sg-v2.sql')));
        }
    }
}
