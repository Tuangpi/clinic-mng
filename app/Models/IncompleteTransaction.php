<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncompleteTransaction extends Model
{
    use HasFactory, SoftDeletes;

    /* Relationships */
    public function queueTransaction()
    {
        return $this->belongsTo(QueueTransaction::class);
    }
    public function transactions()
    {
        return $this->hasMany(QueueTransaction::class);
    }
    
    /* Scopes */
    public function scopeOwingTransactionReport($query, $branchId, $startDate, $endDate, $patientIds) {
        if ($branchId) {
            $query = $query->where('q.branch_id', $branchId);
        }

        if ($startDate && $endDate) {
            $query = $query->whereRaw('date(q.time_in) between ? and ?', [$startDate, $endDate]);
        }
        else {
            $query = $query->whereYear('q.time_in', \Carbon::now()->format('Y'));
        }

        if ($patientIds) {
            $query = $query->whereIn('q.patient_id', $patientIds);
        }

        return $query
        ->join('queue_transactions as qt', 'qt.id', 'incomplete_transactions.queue_transaction_id')
        ->join('queues as q', 'q.id', 'qt.queue_id')
        ->join('branches as b', 'b.id', 'q.branch_id')
        ->join('patients as px', 'px.id', 'q.patient_id')
        ->whereNull('q.deleted_at')
        ->whereRaw('ifnull(q.is_voided, 0) = 0')
        ->whereRaw('qt.sub_total > qt.amount_to_pay')
        ->Select(
            \DB::raw("date(q.time_in) as date"),
            'q.time_in',
            'incomplete_transactions.item_code',
            'incomplete_transactions.name',
            'incomplete_transactions.session_count',
            'incomplete_transactions.price',
            'incomplete_transactions.remaining_balance',
            'q.id as queue_id',
            'q.code as ref_no',
            \DB::raw("concat(px.code, ' - ', px.first_name, ' ', px.last_name) as patient"),
            'b.description as branch',
            'b.currency_symbol'
        );
    }

    public function scopeForQueue($query, $branchId, $patientId) {
        if ($branchId) {
            $query = $query->where('q.branch_id', $branchId);
        }
        return $query
        ->where('q.patient_id', $patientId)
        ->where(function ($query) {
            $query->where('incomplete_transactions.remaining_session', '>', 0)
                ->oRwhere('incomplete_transactions.remaining_balance', '>', 0);
        })
        ->join('queue_transactions as qt', 'qt.id', 'incomplete_transactions.queue_transaction_id')
        ->join('queues as q', 'q.id', 'qt.queue_id')
        ->Select(
            'incomplete_transactions.id',
            'incomplete_transactions.product_id',
            'incomplete_transactions.package_id',
            'incomplete_transactions.item_code',
            'incomplete_transactions.name',
            'incomplete_transactions.session_count',
            'incomplete_transactions.remaining_session',
            'incomplete_transactions.price',
            'incomplete_transactions.remaining_balance',
            'incomplete_transactions.updated_at',
            \DB::raw("(case when incomplete_transactions.package_id is not null then (
                select 
                    group_concat(
                    concat(
                    case when qtp.qty is not null then concat(format(qtp.qty, 0), ' ') else '' end,
                    qtp.name,
                    case when p.is_stock_unlimited = 1 then '' else concat(' (', format(p.current_stock,0) , ')') end
                    )
                    SEPARATOR ', ') as package_details
                    from queue_transaction_products qtp
                    join products p on p.id = qtp.product_id
                    where qtp.queue_transaction_id = incomplete_transactions.queue_transaction_id
            ) else '' end) as package_details"),

        );

    }
}
