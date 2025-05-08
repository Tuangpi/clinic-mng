<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Queue extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function transactions()
    {
        return $this->hasMany(QueueTransaction::class);
    }
    public function payments()
    {
        return $this->hasMany(QueuePayment::class);
    }

    /* Scopes */
    public function scopeActive($query, $branchId, $date, $status) {
        if ($branchId) {
            $query = $query->where('queues.branch_id', $branchId);
        }
        
        switch ($status) {
            case 'Draft':
                $query = $query->where('queues.is_draft', true);
                break;
            case 'Posted':
                $query = $query->where('queues.is_draft', false)
                            ->where(function($query) {
                                $query->whereNull('queues.is_voided')
                                ->orWhere('queues.is_voided', false);
                            });
                break;
            case 'Voided':
                $query = $query->where('queues.is_voided', true);
                break;
        }

        return $query
        ->join('branches as b', 'b.id', 'queues.branch_id')
        ->join('patients as p', 'p.id', 'queues.patient_id')
        ->join('queue_statuses as s', 's.id', 'queues.queue_status_id')
        ->leftJoin(\DB::raw("
        (
            SELECT
              qt.queue_id,
              GROUP_CONCAT(
                CONCAT(
                  '[',
                  queues.code,
                  '] ',
                  it.item_code,
                  ' (',
                  b.currency_symbol,
                  FORMAT(it.remaining_balance, 2),
                  ')'
                ) SEPARATOR '<br/>'
              ) AS balance
            FROM
              incomplete_transactions it
              INNER JOIN queue_transactions qt ON qt.id = it.queue_transaction_id
              INNER JOIN queues ON queues.id = qt.queue_id
              INNER JOIN branches b ON b.id = queues.branch_id
            WHERE
              it.remaining_balance > 0
              AND it.deleted_at IS NULL
            GROUP BY
              qt.queue_id
            UNION ALL
            SELECT
              qt.queue_id,
              GROUP_CONCAT(
                CONCAT(
                  '[',
                  queues.code,
                  '] ',
                  it.item_code,
                  ' (',
                  b.currency_symbol,
                  FORMAT(it.remaining_balance, 2),
                  ')'
                ) SEPARATOR '<br/>'
              ) AS balance
            FROM
              incomplete_transactions it
              INNER JOIN queue_transactions qt ON qt.incomplete_transaction_id = it.id
              INNER JOIN queues ON queues.id = qt.queue_id
              INNER JOIN branches b ON b.id = queues.branch_id
            WHERE
              it.remaining_balance > 0
              AND it.deleted_at IS NULL
            GROUP BY
              qt.queue_id
          ) as balance
        "), 'balance.queue_id', 'queues.id')
        ->whereDate('queues.time_in', $date)
        ->Select(
            'queues.id',
            'queues.patient_id',
            'queues.branch_id',
            'queues.queue_status_id',
            'queues.code',
            \DB::raw("concat(p.code, ' - ', p.first_name, ' ', p.last_name) as patient"),
            'queues.appointment_schedule',
            'queues.time_in',
            'queues.time_out',
            'queues.notes',
            'queues.total_amount',
            'queues.paid_amount',
            'queues.is_draft',
            'queues.is_voided',
            's.description as status',
            'p.photo_ext',
            'p.updated_at as patient_updated_at',
            'b.currency_symbol',
            'balance.balance',
        );
    }

    public function scopeActiveByPatient($query, $branchId, $patientId) {
        if ($branchId) {
            $query = $query->where('queues.branch_id', $branchId);
        }

        return $query
        ->join('branches as b', 'b.id', 'queues.branch_id')
        ->join('queue_statuses as s', 's.id', 'queues.queue_status_id')
        ->leftJoin(\DB::raw("
        (
            SELECT
              qt.queue_id,
              GROUP_CONCAT(
                CONCAT(
                  '[',
                  queues.code,
                  '] ',
                  it.item_code,
                  ' (',
                  b.currency_symbol,
                  FORMAT(it.remaining_balance, 2),
                  ')'
                ) SEPARATOR '<br/>'
              ) AS balance
            FROM
              incomplete_transactions it
              INNER JOIN queue_transactions qt ON qt.id = it.queue_transaction_id
              INNER JOIN queues ON queues.id = qt.queue_id
              INNER JOIN branches b ON b.id = queues.branch_id
            WHERE
              it.remaining_balance > 0
              AND it.deleted_at IS NULL
            GROUP BY
              qt.queue_id
            UNION ALL
            SELECT
              qt.queue_id,
              GROUP_CONCAT(
                CONCAT(
                  '[',
                  queues.code,
                  '] ',
                  it.item_code,
                  ' (',
                  b.currency_symbol,
                  FORMAT(it.remaining_balance, 2),
                  ')'
                ) SEPARATOR '<br/>'
              ) AS balance
            FROM
              incomplete_transactions it
              INNER JOIN queue_transactions qt ON qt.incomplete_transaction_id = it.id
              INNER JOIN queues ON queues.id = qt.queue_id
              INNER JOIN branches b ON b.id = queues.branch_id
            WHERE
              it.remaining_balance > 0
              AND it.deleted_at IS NULL
            GROUP BY
              qt.queue_id
          ) as balance
        "), 'balance.queue_id', 'queues.id')
        ->where('queues.patient_id', $patientId)
        ->Select(
            'queues.id',
            'queues.patient_id',
            'queues.branch_id',
            'queues.queue_status_id',
            'queues.code',
            'queues.appointment_schedule',
            'queues.time_in',
            'queues.time_out',
            'queues.notes',
            'queues.total_amount',
            'queues.paid_amount',
            'queues.is_draft',
            'queues.is_voided',
            's.description as status',
            'b.currency_symbol',
            'balance.balance'
        );
    }

    
    public function scopeVoidedTransactionReport($query, $branchId, $startDate, $endDate, $patient) {
        if ($branchId) {
            $query = $query->where('queues.branch_id', $branchId);
        }
        
        if ($startDate && $endDate) {
            $query = $query->whereRaw('date(queues.time_in) between ? and ?', [$startDate, $endDate]);
        }

        if (count($patient) > 0) {
            $query = $query->whereIn('patient_id', $patient);
        }

        return $query
        ->join('branches as b', 'b.id', 'queues.branch_id')
        ->join('patients as p', 'p.id', 'queues.patient_id')
        ->join('users as v', 'v.id', 'queues.voided_by')
        ->where('queues.is_voided', true)
        ->Select(
            'queues.time_in',
            'queues.code',
            \DB::raw("concat(p.code, ' - ', p.first_name, ' ', p.last_name) as patient"),
            'queues.paid_amount',
            'queues.overall_disc_amount',
            'queues.px_credit',
            'b.currency_symbol',
            \DB::raw("concat(v.first_name, ' ', v.last_name) as voided_by"),
            'b.description as branch',
            \DB::raw("(select
            group_concat(
            concat(
            po.description, ' - ', b.currency_symbol, format(qp.amount, 2)
            ) 
            SEPARATOR '|') as modes
            from queue_payments qp
            join payment_options po on po.id = qp.payment_option_id
            where qp.queue_id = queues.id and qp.deleted_at is null) as modes"),
        );
    }
}
