<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uoms = \DB::table('uoms');
        if ($uoms->count() == 0) {
            $uoms->insert([
                ['description' => 'Amount', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Amp', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Bottle', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Box', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Cap/s', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Cc', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Dose', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Drop/s', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Enema', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Eye Thinly', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Gm', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Lozenge', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Mark/s', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Ml/s', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Pc/s', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Per Nostril', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Pessary', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Puffs', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Pump', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Sachet', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Scalp', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Sparingly', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Spray', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Supp', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Tab Under Tongue', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Tab/s', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Tablespoon', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Teaspoons', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Thinly', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'To Spots', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'To Ulcer Thinly', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Tube', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Ulcer Thinly', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Unit', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Vaginal Tab/s', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Vial', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                ['description' => 'Syringe', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36']
            ]);
        }
    }
}
