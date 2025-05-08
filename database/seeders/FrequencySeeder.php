<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $frequencies = \DB::table('frequencies');
        if ($frequencies->count() == 0) {
            $frequencies->insert([
                ['description' => '2 times a day', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => '3 TIMES A DAY', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'BEFORE LUNCH& BEFORE DINNER', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Daily', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'EVERY MORNING', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Every Morning BEFORE Food', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'EVERY NIGHT', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Use As Instructed', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
            ]);
        }
    }
}
