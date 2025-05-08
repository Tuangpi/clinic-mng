<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QueueTransaction extends Model
{
    use HasFactory, SoftDeletes;

    /* Relationships */
    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    
    public function incompleteTransaction()
    {
        return $this->hasOne(IncompleteTransaction::class);
    }

    public function parentIncompleteTransaction()
    {
        return $this->belongsTo(IncompleteTransaction::class, 'incomplete_transaction_id');
    }
    
    public function packageProducts()
    {
        return $this->hasMany(QueueTransactionProduct::class);
    }
    
    public function usage()
    {
        return $this->belongsTo(Usage::class);
    }
    
    public function dosage()
    {
        return $this->belongsTo(Dosage::class);
    }
    
    public function dosageUom()
    {
        return $this->belongsTo(Uom::class, 'dosage_uom_id');
    }
    
    public function frequency()
    {
        return $this->belongsTo(Frequency::class);
    }

    /* Scopes */
    public function scopeItemDispensedReport($query, $branchId, $productIds, $startDate, $endDate, $categoryIds, $typeIds) {
        if ($branchId) {
            $query = $query->where('q.branch_id', $branchId);
        }
        if ($productIds) {
            $query = $query->whereIn('queue_transactions.product_id', $productIds);
        }
        if ($startDate && $endDate) {
            $query = $query->whereRaw('date(q.time_in) between ? and ?', [$startDate, $endDate]);
        }
        else {
            $query = $query->whereYear('q.time_in', \Carbon::now()->format('Y'));
        }

        if ($categoryIds) {
            $query = $query->whereIn('p.product_category_id', $categoryIds);
        }

        if ($typeIds) {
            $query = $query->whereIn('p.product_type_id', $typeIds);
        }

        return $query
        ->join('queues as q', 'q.id', 'queue_transactions.queue_id')
        ->join('branches as b', 'b.id', 'q.branch_id')
        ->join('patients as px', 'px.id', 'q.patient_id')
        ->join('products as p', 'p.id', 'queue_transactions.product_id')
        ->join('product_categories as c', 'c.id', 'p.product_category_id')
        ->join('product_types as t', 't.id', 'p.product_type_id')
        ->whereNotNull('queue_transactions.product_id')
        ->where('q.is_draft', 0)
        ->whereRaw('ifnull(q.is_voided, 0) = 0')
        ->Select(
            'q.time_in',
            'queue_transactions.item_code',
            'queue_transactions.name',
            'queue_transactions.qty',
            'queue_transactions.uom',
            'c.description as category',
            't.description as type',
            'queue_transactions.unit_price',
            'queue_transactions.total_amount',
            'queue_transactions.disc_percentage',
            'queue_transactions.disc_amount',
            'queue_transactions.sub_total',
            'q.code',
            \DB::raw("concat(px.code, ' - ', px.first_name, ' ', px.last_name) as patient"),
            'b.description as branch',
            'b.currency_symbol'
        );
    }
    
    public function scopeForSessionBalanceLogs($query, $trId, $itId) {
        return $query
        ->join('queues as q', 'q.id', 'queue_transactions.queue_id')
        ->where('queue_transactions.id', $trId)
        ->orWhere('queue_transactions.incomplete_transaction_id',$itId)
        ->select(
            'q.code',
            'queue_transactions.total_amount',
            'queue_transactions.amount_to_pay',
            'queue_transactions.from_overall_discount',
            \DB::raw('queue_transactions.total_amount - (queue_transactions.amount_to_pay + ifnull(queue_transactions.from_overall_discount, 0)) as balance'),
            'queue_transactions.is_session_used'
        )
        ->orderBy('q.id');
    }

    public function scopeDetailedBillingSummaryReport($query, $branchId, $startDate, $endDate, $patientIds)
    {
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
      ->join('queues as q', 'q.id', 'queue_transactions.queue_id')
          ->join('branches as b', 'b.id', 'q.branch_id')
          ->join('patients as p', 'p.id', 'q.patient_id')
          ->leftJoin('products as prod', 'prod.id', 'queue_transactions.product_id')
          ->leftJoin('packages as pck', 'pck.id', 'queue_transactions.package_id')
          ->leftJoin('product_types as pt', 'pt.id', 'prod.product_type_id')
          ->leftJoin('product_types as pckt', 'pckt.id', 'pck.product_type_id')
          ->where('q.is_draft', false)
          ->whereRaw("ifnull(q.is_voided,0) = 0")
          ->select(
            \DB::raw("date(q.time_in) as date"),
            \DB::raw("concat(p.code, ' - ', p.first_name, ' ' , p.last_name) as patient"),
            'p.nric',
            'p.address',
            'queue_transactions.name as item_name',
            'queue_transactions.qty',
            'queue_transactions.uom',
            \DB::raw("ifnull(pt.description, pckt.description) as item_type"),
            'queue_transactions.sub_total',
            'b.description as branch',
            'b.currency_symbol'
        )
        ->orderBy('date')
        ->orderBy('p.code');
    }

    public function scopeDrugUsageProductReport($query, $branchId, $startDate, $endDate, $patientIds)
    {
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
      ->join('queues as q', 'q.id', 'queue_transactions.queue_id')
          ->join('branches as b', 'b.id', 'q.branch_id')
          ->join('patients as p', 'p.id', 'q.patient_id')
          ->join('products as prod', 'prod.id', 'queue_transactions.product_id')
          ->whereNotNull('queue_transactions.product_id')
          ->where('q.is_draft', false)
          ->whereRaw("ifnull(q.is_voided,0) = 0")
          ->select(
            'queue_transactions.item_code',
            'queue_transactions.name as item_name',
            \DB::raw("sum(queue_transactions.qty) as qty"),
            'queue_transactions.uom',
            \DB::raw("sum((queue_transactions.qty * prod.cost_price)) as cost_amount"),
            \DB::raw("sum(queue_transactions.sub_total) as sell_amount"),
            \DB::raw("sum((queue_transactions.sub_total - (queue_transactions.qty * prod.cost_price))) as profit"),
            'b.description as branch',
            'b.currency_symbol'
        )
        ->groupBy('queue_transactions.item_code', 'queue_transactions.name', 'queue_transactions.uom', 'b.description', 'b.currency_symbol');
    }

    public function scopeDrugUsagePackageReport($query, $branchId, $startDate, $endDate, $patientIds)
    {
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
      ->join('queues as q', 'q.id', 'queue_transactions.queue_id')
          ->join('branches as b', 'b.id', 'q.branch_id')
          ->join('patients as p', 'p.id', 'q.patient_id')
          ->join('packages as pck', 'pck.id', 'queue_transactions.package_id')
          ->join('queue_transaction_products as qtp', 'qtp.queue_transaction_id', 'queue_transactions.id')
          ->whereNotNull('queue_transactions.package_id')
          ->where('q.is_draft', false)
          ->whereRaw("ifnull(q.is_voided,0) = 0")
          ->select(
            'queue_transactions.item_code',
            'queue_transactions.name as item_name',
            'queue_transactions.uom',
            \DB::raw("sum(queue_transactions.qty) as qty"),
            \DB::raw("sum((queue_transactions.qty * pck.cost_price)) as cost_amount"),
            \DB::raw("sum(queue_transactions.sub_total) as sell_amount"),
            \DB::raw("sum((queue_transactions.sub_total - (queue_transactions.qty * pck.cost_price))) as profit"),
            'b.description as branch',
            'b.currency_symbol',
            'qtp.item_code as prod_code',
            'qtp.name as prod_name',
            \DB::raw("sum(qtp.qty * queue_transactions.qty) as prod_qty"),
            'qtp.uom as prod_uom'

        )
        ->groupBy('qtp.item_code', 'qtp.name', 'qtp.uom', 'queue_transactions.item_code', 'queue_transactions.name', 'queue_transactions.uom', 'b.description', 'b.currency_symbol');
    }

    public function scopeDetailedPatientHistoryReport($query, $branchId, $patientIds)
    {
        if ($branchId) {
            $query = $query->where('q.branch_id', $branchId);
        }

        if ($patientIds) {
            $query = $query->whereIn('q.patient_id', $patientIds);
        }

      return $query
      ->join('queues as q', 'q.id', 'queue_transactions.queue_id')
          ->join('branches as b', 'b.id', 'q.branch_id')
          ->join('patients as p', 'p.id', 'q.patient_id')
          ->where('q.is_draft', false)
          ->whereRaw("ifnull(q.is_voided,0) = 0")
          ->select(
            \DB::raw("concat(p.code, ' - ', p.first_name, ' ' , p.last_name) as patient"),
            \DB::raw("date(q.time_in) as date"),
            'queue_transactions.item_code',
            'queue_transactions.name as item_name',
            'queue_transactions.unit_price',
            'queue_transactions.qty',
            'queue_transactions.uom',
            'queue_transactions.total_amount',
            'queue_transactions.disc_percentage',
            'queue_transactions.disc_amount',
            'queue_transactions.sub_total',
            'q.code as queue_id',
            'b.description as branch',
            'b.currency_symbol'
          )
          ->orderBy('p.code')
          ->orderBy('date', 'desc');
    }
}
