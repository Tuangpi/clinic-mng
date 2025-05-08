<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AppointmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appointmentStatuses = \DB::table('appointment_statuses');
        if ($appointmentStatuses->count() == 0) {
            $appointmentStatuses->insert([
                [
                    'description' => 'Listed',
                    'hex_color' => '00E7FF',
                    'seq_no' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'description' => 'Informed',
                    'hex_color' => 'FFE15D',
                    'seq_no' => 2,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'description' => 'Confirmed',
                    'hex_color' => '5F8D4E',
                    'seq_no' => 3,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'description' => 'Cancelled',
                    'hex_color' => 'DC3535',
                    'seq_no' => 4,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ]
            ]);
        }
    }
}
