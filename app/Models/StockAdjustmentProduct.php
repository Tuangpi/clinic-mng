<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockAdjustmentProduct extends Model
{
    use HasFactory, SoftDeletes;

    /* Relationships */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /* Scopes */
    public function scopeStockAdjustmentReport($query, $branchId, $productIds, $startDate, $endDate, $typeIds) {
        if ($branchId) {
            $query = $query->where('sa.branch_id', $branchId);
        }
        if ($productIds) {
            $query = $query->whereIn('stock_adjustment_products.product_id', $productIds);
        }
        if ($startDate && $endDate) {
            $query = $query->whereBetween('sa.adjustment_date', [$startDate, $endDate]);
        }
        else {
            $query = $query->whereYear('sa.created_at', \Carbon::now()->format('Y'));
        }
        if ($typeIds) {
            $query = $query->whereIn('sa.stock_adjustment_type_id', $typeIds);
        }

        return $query
        ->join('stock_adjustments as sa', 'sa.id', 'stock_adjustment_products.stock_adjustment_id')
        ->join('stock_adjustment_types as t', 't.id', 'sa.stock_adjustment_type_id')
        ->join('branches as b', 'b.id', 'sa.branch_id')
        ->join('products as p', 'p.id', 'stock_adjustment_products.product_id')
        ->join('users as c', 'c.id', 'sa.created_by')
        ->Select(
            'sa.adjustment_date',
            'sa.code',
            't.description as type',
            'p.code as item_code',
            'p.name as item_name',
            'stock_adjustment_products.batch_no',
            'stock_adjustment_products.expiry_date',
            'stock_adjustment_products.current_stock',
            'stock_adjustment_products.qty',
            'stock_adjustment_products.updated_stock',
            'stock_adjustment_products.uom',
            \DB::raw("concat(c.first_name, ' ', c.last_name) as adjusted_by"),
            'b.description as branch'
        );
    }
}
