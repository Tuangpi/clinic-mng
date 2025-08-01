<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionSummaryPaymentModesWithoutExcludedView extends Migration
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
    public function down()
    {
        \DB::statement($this->dropView());
    }
     /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function createView(): string
    {
        return <<<SQL
CREATE VIEW view_transaction_summary_payment_modes_without_excluded AS
    Select
    date(q.created_at) as date,
    po.id as mode_id,
    po.description as mode,
    qp.amount,
    q.branch_id,
    q.patient_id,
    b.description as branch,
    b.currency_symbol
    from
    queue_payments qp
    join payment_options po on po.id = qp.payment_option_id
    join queues q on q.id = qp.queue_id
    join patients p on p.id = q.patient_id
    join branches b on b.id = q.branch_id
    where qp.deleted_at is null and po.sales_report_excluded = 0 and q.is_draft = 0 and q.deleted_at is null and ifnull(q.is_voided,0) = 0

    union 

    Select
    date(pc.created_at) as date,
    0 as mode_id,
    concat(case when pc.amount < 0 then 'Refund' else 'Load' end,' Credit') as modes,
    pc.amount,
    pc.branch_id,
    pc.patient_id,
    b.description as branch,
    b.currency_symbol
    from 
    patient_credits pc
    join patients p on p.id = pc.patient_id
    join branches b on b.id = pc.branch_id
    where pc.amount < 0 and pc.deleted_at is null;
SQL;
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return <<<SQL

DROP VIEW IF EXISTS `view_transaction_summary_payment_modes_without_excluded`;
SQL;
    }
}
