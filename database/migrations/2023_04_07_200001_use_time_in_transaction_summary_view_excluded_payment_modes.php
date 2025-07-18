<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UseTimeInTransactionSummaryViewExcludedPaymentModes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createView());
    }

     /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function createView(): string
    {
        return <<<SQL
            CREATE OR REPLACE VIEW view_transaction_summary_without_excluded_payment_modes AS
            Select
            date(q.time_in) as date,
            q.time_in,
            q.code as ref_no,
            concat(p.code, ' - ', p.first_name, ' ' , p.last_name) as patient,
            (select
            group_concat(
            concat(
            po.description, ' - ', b.currency_symbol, format(qp.amount, 2)
            ) 
            SEPARATOR '|') as modes
            from queue_payments qp
            join payment_options po on po.id = qp.payment_option_id
            where po.sales_report_excluded = 0 and qp.queue_id = q.id and qp.deleted_at is null) as modes,
            (
            Select sum(qp.amount)
            from queue_payments qp
            join payment_options po on po.id = qp.payment_option_id
            where po.sales_report_excluded = 0 and qp.queue_id = q.id and qp.deleted_at is null
            ) as paid_amount,
            q.overall_disc_amount,
            q.px_credit,
            b.description as branch,
            q.branch_id,
            q.patient_id,
            b.currency_symbol
            from
            queues q
            join patients p on p.id = q.patient_id
            join branches b on b.id = q.branch_id
            where q.is_draft = 0 and q.deleted_at is null and ifnull(q.is_voided,0) = 0
            SQL;
    }
}
