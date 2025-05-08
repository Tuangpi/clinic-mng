<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StockAdjustmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stockAdjustmentTypes = \DB::table('stock_adjustment_types');
        if ($stockAdjustmentTypes->count() == 0) {
            $stockAdjustmentTypes->insert([
                [
                    'description' => 'Manual Adjustments',
                    'is_system_default' => true,
                    'seq_no' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'description' => 'Stock Transfer (Sender)',
                    'is_system_default' => true,
                    'seq_no' => 2,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'description' => 'Stock Transfer (Receiver)',
                    'is_system_default' => true,
                    'seq_no' => 3,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'description' => 'Return to Supplier',
                    'is_system_default' => true,
                    'seq_no' => 4,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'description' => 'Others',
                    'is_system_default' => true,
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
