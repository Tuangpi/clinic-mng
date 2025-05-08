<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taxes = \DB::table('taxes');
        if ($taxes->count() == 0) {
            $taxes->insert([
                [
                    'code' => '01',
                    'percentage' => 12,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ]
            ]);
        }
    }
}
