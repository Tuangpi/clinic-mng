<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AppointmentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appointmentCategories = \DB::table('appointment_categories');
        if ($appointmentCategories->count() == 0) {
            $appointmentCategories->insert([
                [
                    'branch_id' => 1,
                    'description' => 'Consultation',
                    'hex_color' => '99FF99',
                    'seq_no' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'branch_id' => 1,
                    'description' => 'Review',
                    'hex_color' => '81E3CA',
                    'seq_no' => 2,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'branch_id' => 1,
                    'description' => 'Procedure',
                    'hex_color' => 'FDA769',
                    'seq_no' => 3,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ]
            ]);
        }

        // if (!$appointmentCategories->where('branch_id', 3)->exists()) {
        //     $appointmentCategories->insert([
        //         [
        //             'branch_id' => 3,
        //             'description' => 'Consultation',
        //             'hex_color' => '99FF99',
        //             'seq_no' => 1,
        //             'created_by' => 1,
        //             'updated_by' => 1,
        //             'created_at' => '2022-10-30 15:14:36',
        //             'updated_at' => '2022-10-30 15:14:36'
        //         ],
        //         [
        //             'branch_id' => 3,
        //             'description' => 'Review',
        //             'hex_color' => '81E3CA',
        //             'seq_no' => 2,
        //             'created_by' => 1,
        //             'updated_by' => 1,
        //             'created_at' => '2022-10-30 15:14:36',
        //             'updated_at' => '2022-10-30 15:14:36'
        //         ],
        //         [
        //             'branch_id' => 3,
        //             'description' => 'Procedure',
        //             'hex_color' => 'FDA769',
        //             'seq_no' => 3,
        //             'created_by' => 1,
        //             'updated_by' => 1,
        //             'created_at' => '2022-10-30 15:14:36',
        //             'updated_at' => '2022-10-30 15:14:36'
        //         ],
        //         [
        //             'branch_id' => 3,
        //             'description' => 'Nurse Amy',
        //             'hex_color' => '00BCD4',
        //             'seq_no' => 4,
        //             'created_by' => 1,
        //             'updated_by' => 1,
        //             'created_at' => '2022-10-30 15:14:36',
        //             'updated_at' => '2022-10-30 15:14:36'
        //         ],
        //         [
        //             'branch_id' => 3,
        //             'description' => 'Consultation',
        //             'hex_color' => '9C27B0',
        //             'seq_no' => 5,
        //             'created_by' => 1,
        //             'updated_by' => 1,
        //             'created_at' => '2022-10-30 15:14:36',
        //             'updated_at' => '2022-10-30 15:14:36'
        //         ]
        //     ]);
        // }
    }
}
