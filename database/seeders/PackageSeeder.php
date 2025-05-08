<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = \DB::table('packages');
        if ($packages->count() == 0) {
            $packages->insert([
                [
                    'code' => 'PK-01-00001-Code1',
                    'code2' => 'Code1',
                    'name' => 'Laser Hair Removal Package',
                    'description' => 'Laser Hair Removal Package desc',
                    'branch_id' => 1,
                    'product_type_id' => 3,
                    'product_category_id' => 3,
                    'selling_price' => 10000,
                    'cost_price' => 10000,
                    'session_count' => 5,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'PK-01-00002-Code2',
                    'code2' => 'Code2',
                    'name' => 'Mupirucin Set',
                    'description' => 'Mupirucin Set desc',
                    'branch_id' => 1,
                    'product_type_id' => 3,
                    'product_category_id' => 3,
                    'selling_price' => 15000,
                    'cost_price' => 15000,
                    'session_count' => 0,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'PK-01-00003-Code3',
                    'code2' => 'Code3',
                    'name' => 'Diamond Peel Package',
                    'description' => 'Diamond Peel Package desc',
                    'branch_id' => 1,
                    'product_type_id' => 3,
                    'product_category_id' => 3,
                    'selling_price' => 7000,
                    'cost_price' => 7000,
                    'session_count' => 3,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ]
            ]);

            \DB::table('package_products')->insert([
                ['package_id' => 1,
                'product_id' => 1,
                'qty' => 3,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2022-10-30 15:14:36',
                'updated_at' => '2022-10-30 15:14:36'],
                ['package_id' => 2,
                'product_id' => 1,
                'qty' => 5,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2022-10-30 15:14:36',
                'updated_at' => '2022-10-30 15:14:36'],
                ['package_id' => 2,
                'product_id' => 2,
                'qty' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2022-10-30 15:14:36',
                'updated_at' => '2022-10-30 15:14:36'],
                ['package_id' => 3,
                'product_id' => 1,
                'qty' => 5,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2022-10-30 15:14:36',
                'updated_at' => '2022-10-30 15:14:36']
            ]);
        }
    }
}
