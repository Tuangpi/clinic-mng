<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users');
        if ($users->count() == 0) {
            $users->insert([
                [
                    'code' => 'U-00001',
                    'first_name' => 'System',
                    'last_name' => 'Admin',
                    'username' => 'cms.admin',
                    'email' => 'cmsad@mailinator.com',
                    'user_role_id' => 1,
                    'photo_ext' => 'jpg',
                    'password' => '$2y$10$hgcpoXKizYzB3Gqea8GmRelVRc0O1HdL.Hnx5S1RfOVn4LT1mkgrm',
                    'created_at' => '2022-08-06 22:52:36',
                    'updated_at' => '2022-08-06 22:52:36'
            ],
                [
                    'code' => 'U-00002',
                    'first_name' => 'Front',
                    'last_name' => 'Desk',
                    'username' => 'cms.frontdesk',
                    'email' => 'cmsfd@mailinator.com',
                    'user_role_id' => 2,
                    'photo_ext' => null,
                    'password' => '$2y$10$hgcpoXKizYzB3Gqea8GmRelVRc0O1HdL.Hnx5S1RfOVn4LT1mkgrm',
                    'created_at' => '2022-08-06 22:52:36',
                    'updated_at' => '2022-08-06 22:52:36'
                ]
            ]);


            DB::table('branch_user')->insert([
                ['user_id' => 2,
                'branch_id' => 1,
                'created_at' => '2022-08-06 22:52:36',
                'updated_at' => '2022-08-06 22:52:36']
            ]);
        }
    }
}
