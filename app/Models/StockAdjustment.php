<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockAdjustment extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    public function otherBranch()
    {
        return $this->belongsTo(Branch::class);
    }
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function stockAdjustmentType()
    {
        return $this->belongsTo(StockAdjustmentType::class);
    }

    public function products()
    {
        return $this->hasMany(StockAdjustmentProduct::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /* Scopes */
    public function scopeActive($query, $branchId, $startDate, $endDate) {
        if ($branchId) {
            $query = $query->where('stock_adjustments.branch_id', $branchId);
        }
        if ($startDate && $endDate) {
            $query = $query->whereBetween('stock_adjustments.adjustment_date', [$startDate, $endDate]);
        }
        else {
            $query = $query->whereYear('stock_adjustments.adjustment_date', \Carbon::now()->format('Y'));
        }
        
        return $query
        ->join('branches as b', 'b.id', 'stock_adjustments.branch_id')
        ->join('users as u', 'u.id', 'stock_adjustments.created_by')
        ->Select(
            'stock_adjustments.id',
            'stock_adjustments.code',
            'stock_adjustments.adjustment_date',
            \DB::raw("concat(u.first_name, ' ', u.last_name) as created_by"),
            'b.description as branch'
        );
    }
}
