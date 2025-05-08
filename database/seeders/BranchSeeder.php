<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = DB::table('branches');
        if ($branches->count() == 0) {
            $branches->insert([
                [
                    'code' => 'DC-ORC',
                    'description' => 'Orchard',
                    'address' => '350 Orchard Rd, #10-01 Shaw House, Singapore',
                    'tel_no' => '89031948',
                    'print_header' => 'Dr Chio Aestetic & Laser Centre (Orchard) Pte Ltd',
                    'currency_symbol' => '$',
                    'co_reg_no' => '202139774H',
                    'created_at' => '2022-10-30 15:14:36',
                    'updated_at' => '2022-10-30 15:14:36'
                ]
            ]);
        }
    }
}
