<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QueueTransactionProduct extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    public function product()
    {
        return $this->belongsTo(Product::class);
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
            $query = $query->whereIn('queue_transaction_products.product_id', $productIds);
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
        ->join('queue_transactions as qt', 'qt.id', 'queue_transaction_products.queue_transaction_id')
        ->join('queues as q', 'q.id', 'qt.queue_id')
        ->join('branches as b', 'b.id', 'q.branch_id')
        ->join('patients as px', 'px.id', 'q.patient_id')
        ->join('products as p', 'p.id', 'queue_transaction_products.product_id')
        ->join('product_categories as c', 'c.id', 'p.product_category_id')
        ->join('product_types as t', 't.id', 'p.product_type_id')
        ->whereNotNull('qt.package_id')
        ->where('q.is_draft', 0)
        ->whereRaw('ifnull(q.is_voided, 0) = 0')
        ->whereRaw('((qt.session_count > 0 and qt.is_session_used = 1) or (qt.session_count = 0 and qt.incomplete_transaction_id is null))')
        ->Select(
            'q.time_in',
            'queue_transaction_products.item_code',
            'queue_transaction_products.name',
            \DB::raw('((case when (qt.session_count > 0 and qt.is_session_used = 1) then 1 else (case when qt.qty = 0 then 1 else qt.qty end) end) * queue_transaction_products.qty) as qty'),
            'queue_transaction_products.uom',
            'c.description as category',
            't.description as type',
            \DB::raw('null as unit_price'),
            \DB::raw('null as total_amount'),
            \DB::raw('null as disc_percentage'),
            \DB::raw('null as disc_amount'),
            \DB::raw('null as sub_total'),
            'q.code',
            \DB::raw("concat(px.code, ' - ', px.first_name, ' ', px.last_name) as patient"),
            'b.description as branch',
            'b.currency_symbol'
        );
    }
}
