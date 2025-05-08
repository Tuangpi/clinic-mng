<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QueueStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $queueStatuses = \DB::table('queue_statuses');
        if ($queueStatuses->count() == 0) {
            $queueStatuses->insert([
                [
                    'branch_id' => 1,
                    'description' => 'Waiting',
                    'hex_color' => 'ff9800',
                    'seq_no' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'branch_id' => 1,
                    'description' => 'On Procedure',
                    'hex_color' => 'ea4335',
                    'seq_no' => 2,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'branch_id' => 1,
                    'description' => 'Done',
                    'hex_color' => '33a853',
                    'seq_no' => 3,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ]
            ]);
        }

        
    }
}
