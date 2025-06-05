<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = \DB::table('products');
        if ($products->count() == 0) {
            \DB::unprepared(file_get_contents(storage_path('sql/products-sg.sql')));
        }
        $products = \DB::table('products');
        if ($products->count() == 0) {
            $products->insert([
                [
                    'code' => 'PR-01-00001-Code1',
                    'code2' => 'Code1',
                    'name' => 'Mupirucin',
                    'description' => 'Mupirucin desc',
                    'branch_id' => 1,
                    'product_type_id' => 1,
                    'product_category_id' => 1,
                    'supplier_id' => 1,
                    'manufacturer_id' => 1,
                    'uom_id' => 1,
                    'selling_price' => 1000,
                    'cost_price' => 1000,
                    'current_stock' => 1000,
                    'is_stock_unlimited' => false,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'PR-01-00002-Code2',
                    'code2' => 'Code2',
                    'name' => 'First Consultation',
                    'description' => 'First Consultation desc',
                    'branch_id' => 1,
                    'product_type_id' => 2,
                    'product_category_id' => 2,
                    'supplier_id' => 1,
                    'manufacturer_id' => 1,
                    'uom_id' => 1,
                    'selling_price' => 2000,
                    'cost_price' => 2000,
                    'current_stock' => 0,
                    'is_stock_unlimited' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'PR-01-00003-Code3',
                    'code2' => 'Code3',
                    'name' => 'Warts Removal Face and Neck',
                    'description' => 'Warts Removal Face and Neck desc',
                    'branch_id' => 1,
                    'product_type_id' => 3,
                    'product_category_id' => 3,
                    'supplier_id' => 1,
                    'manufacturer_id' => 1,
                    'uom_id' => 1,
                    'selling_price' => 3000,
                    'cost_price' => 3000,
                    'current_stock' => 0,
                    'is_stock_unlimited' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'PR-03-00001-Code1',
                    'code2' => 'Code1',
                    'name' => 'Mupirucin',
                    'description' => 'Mupirucin desc',
                    'branch_id' => 3,
                    'product_type_id' => 1,
                    'product_category_id' => 1,
                    'supplier_id' => 1,
                    'manufacturer_id' => 1,
                    'uom_id' => 1,
                    'selling_price' => 1000,
                    'cost_price' => 1000,
                    'current_stock' => 1000,
                    'is_stock_unlimited' => false,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'PR-03-00002-Code2',
                    'code2' => 'Code2',
                    'name' => 'First Consultation',
                    'description' => 'First Consultation desc',
                    'branch_id' => 3,
                    'product_type_id' => 2,
                    'product_category_id' => 2,
                    'supplier_id' => 1,
                    'manufacturer_id' => 1,
                    'uom_id' => 1,
                    'selling_price' => 2000,
                    'cost_price' => 2000,
                    'current_stock' => 0,
                    'is_stock_unlimited' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ],
                [
                    'code' => 'PR-03-00003-Code3',
                    'code2' => 'Code3',
                    'name' => 'Warts Removal Face and Neck',
                    'description' => 'Warts Removal Face and Neck desc',
                    'branch_id' => 3,
                    'product_type_id' => 3,
                    'product_category_id' => 3,
                    'supplier_id' => 1,
                    'manufacturer_id' => 1,
                    'uom_id' => 1,
                    'selling_price' => 3000,
                    'cost_price' => 3000,
                    'current_stock' => 0,
                    'is_stock_unlimited' => true,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ]
            ]);
        }
    }
}
