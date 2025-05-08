<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CaseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $caseTypes = \DB::table('case_types');
        if ($caseTypes->count() == 0) {
            $caseTypes->insert([
                [
                    'description' => 'Casenotes',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'description' => 'Doctor Procedure\'s',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'description' => 'Nurse Procedure\'s',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'description' => 'LabReports',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'description' => 'Certificate',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ]
            ]);
        }
    }
}
