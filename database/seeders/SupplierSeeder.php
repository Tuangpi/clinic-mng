<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = \DB::table('suppliers');
        if ($suppliers->count() == 0) {
            $suppliers->insert([
                [
                    'code' => 'SUP-00001',
                    'name' => 'DrChioB',
                    'address' => '',
                    'city_id' => 1,
                    'mobile_number' => '',
                    'is_supplier' => true,
                    'is_manufacturer' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'SUP-00002',
                    'name' => 'Pan-Malayan Pharmaeuticals Pte Ltd',
                    'address' => '',
                    'city_id' => 1,
                    'mobile_number' => '',
                    'is_supplier' => true,
                    'is_manufacturer' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'SUP-00003',
                    'name' => 'Integrated Contract Manufacturing P/L',
                    'address' => '',
                    'city_id' => 1,
                    'mobile_number' => '',
                    'is_supplier' => true,
                    'is_manufacturer' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'SUP-00004',
                    'name' => 'ZUELLIG PHARMA PTE LTD',
                    'address' => '',
                    'city_id' => 1,
                    'mobile_number' => '',
                    'is_supplier' => true,
                    'is_manufacturer' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'SUP-00005',
                    'name' => 'CLEX MEDICALS PTE LTD',
                    'address' => '',
                    'city_id' => 1,
                    'mobile_number' => '',
                    'is_supplier' => true,
                    'is_manufacturer' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'SUP-00006',
                    'name' => 'Absolute MS [S] Pte Ltd',
                    'address' => '',
                    'city_id' => 1,
                    'mobile_number' => '',
                    'is_supplier' => true,
                    'is_manufacturer' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'SUP-00007',
                    'name' => 'Amber Compounding Pharmacy Pte Ltd',
                    'address' => '',
                    'city_id' => 1,
                    'mobile_number' => '',
                    'is_supplier' => true,
                    'is_manufacturer' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'SUP-00008',
                    'name' => 'ALCARE PHARMACEUTICALS PTE LTD',
                    'address' => '',
                    'city_id' => 1,
                    'mobile_number' => '',
                    'is_supplier' => true,
                    'is_manufacturer' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'SUP-00009',
                    'name' => 'YSP',
                    'address' => '',
                    'city_id' => 1,
                    'mobile_number' => '',
                    'is_supplier' => true,
                    'is_manufacturer' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'SUP-00010',
                    'name' => 'Others',
                    'address' => '',
                    'city_id' => 1,
                    'mobile_number' => '',
                    'is_supplier' => true,
                    'is_manufacturer' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ]
            ]);
        }
    }
}
