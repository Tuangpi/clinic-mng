<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentOptions = \DB::table('payment_options');
        if ($paymentOptions->count() == 0) {
            $paymentOptions->insert([
                [ 'branch_id' => 1, 'description' => 'Cash', 'seq_no' => 1, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Nets', 'seq_no' => 2, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'CREDIT CARD VISA', 'seq_no' => 3, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Cheque', 'seq_no' => 4, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Amex', 'seq_no' => 5, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Others', 'seq_no' => 6, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Medisave', 'seq_no' => 7, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Telex', 'seq_no' => 8, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Cashless', 'seq_no' => 9, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Deposit', 'seq_no' => 10, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Offset', 'seq_no' => 11, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Chas', 'seq_no' => 12, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Credit Card Master', 'seq_no' => 13, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Atome', 'seq_no' => 14, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Wechat Pay', 'seq_no' => 15, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Fave Pay', 'seq_no' => 16, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Paynow', 'seq_no' => 17, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 1, 'description' => 'Owing', 'seq_no' => 18, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36']
            ]);
        }

        if (!$paymentOptions->where('branch_id', 3)->exists()) {
            $paymentOptions->insert([
                [ 'branch_id' => 3, 'description' => 'Cash', 'seq_no' => 1, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Nets', 'seq_no' => 2, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'CREDIT CARD VISA', 'seq_no' => 3, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Cheque', 'seq_no' => 4, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Amex', 'seq_no' => 5, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Others', 'seq_no' => 6, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Medisave', 'seq_no' => 7, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Telex', 'seq_no' => 8, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Cashless', 'seq_no' => 9, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Deposit', 'seq_no' => 10, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Offset', 'seq_no' => 11, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Chas', 'seq_no' => 12, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Credit Card Master', 'seq_no' => 13, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Atome', 'seq_no' => 14, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Wechat Pay', 'seq_no' => 15, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Fave Pay', 'seq_no' => 16, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'branch_id' => 3, 'description' => 'Paynow', 'seq_no' => 17, 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36']
            ]);
        }
    }
}
