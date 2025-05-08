<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DosageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosages = \DB::table('dosages');
        if ($dosages->count() == 0) {
            $dosages->insert([
                ['description' => '1', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => '2', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => '5', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => '60', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36']
                
            ]);
        }
    }
}
