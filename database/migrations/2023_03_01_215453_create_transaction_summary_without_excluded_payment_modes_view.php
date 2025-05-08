<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionSummaryWithoutExcludedPaymentModesView extends Migration
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
CREATE VIEW view_transaction_summary_without_excluded_payment_modes AS
Select
date(q.created_at) as date,
q.created_at,
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

union all

Select
date(pc.credit_date) as date,
pc.credit_date,
pc.code as ref_no,
concat(p.code, ' - ', p.first_name, ' ' , p.last_name) as patient,
concat(case when pc.amount < 0 then 'Refund' else 'Load' end,' Credit', ' (', pc.remarks, ')') as modes,
pc.amount as paid_amount,
0 as overall_disc_amount,
0 as px_credit,
b.description as branch,
pc.branch_id,
pc.patient_id,
b.currency_symbol
from 
patient_credits pc
join patients p on p.id = pc.patient_id
join branches b on b.id = pc.branch_id
where pc.amount < 0 and pc.deleted_at is null;;
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

DROP VIEW IF EXISTS `view_transaction_summary_without_excluded_payment_modes`;
SQL;
    }
}
