<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditTransactionView extends Migration
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
CREATE VIEW view_credit_transactions AS
    SELECT 
        pc.id,
        pc.code,
        pc.created_at,
        pc.amount,
        concat(c.first_name, ' ', c.last_name) as created_by,
        pc.remarks,
        pc.branch_id,
        pc.patient_id
    FROM patient_credits pc
    join branches b on b.id = pc.branch_id
    join users as c on c.id = pc.created_by
    where pc.deleted_at is null

    union

    select
    0 as id,
    '' as code,
    q.posted_date as created_at,
    (q.px_credit * -1) as amount,
    concat(c.first_name, ' ', c.last_name) as created_by,
    concat('From transaction ', q.code) as remarks,
    q.branch_id,
    q.patient_id
    from queues q
    join users as c on c.id = q.created_by
    where q.px_credit > 0 and 
    q.deleted_at is null

    union

    select
    0 as id,
    '' as code,
    q.posted_date as created_at,
    q.px_credit as amount,
    concat(c.first_name, ' ', c.last_name) as created_by,
    concat('From voided transaction ', q.code) as remarks,
    q.branch_id,
    q.patient_id
    from queues q
    join users as c on c.id = q.created_by
    where q.px_credit > 0 and 
    is_voided = 1 and
    q.deleted_at is null
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

DROP VIEW IF EXISTS `view_credit_transactions`;
SQL;
    }
}
