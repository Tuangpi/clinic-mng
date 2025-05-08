<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveLoadCreditTransactionSummaryPaymentModeView extends Migration
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
CREATE OR REPLACE VIEW view_transaction_summary_payment_modes AS
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
    where qp.deleted_at is null and q.is_draft = 0 and q.deleted_at is null and ifnull(q.is_voided,0) = 0

    union all

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
}
