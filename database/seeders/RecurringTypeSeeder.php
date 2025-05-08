<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RecurringTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recurringTypes = \DB::table('recurring_types');
        if ($recurringTypes->count() == 0) {
            $recurringTypes->insert([
                [
                    'description' => 'Daily',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'description' => 'Weekly',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'description' => 'Monthly',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ]
            ]);
        }
    }
}
