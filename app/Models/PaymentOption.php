<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentOption extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    public function queuePayments()
    {
        return $this->hasMany(QueuePayment::class);
    }

    public function purchaseOrderPayments()
    {
        return $this->hasMany(PurchaseOrderPayment::class);
    }
    
    /* Scopes */
    public function scopeActive($query,$branchId) {
        if ($branchId) {
            $query = $query->where('payment_options.branch_id', $branchId);
        }
        return $query
        ->join('branches as b', 'b.id', 'payment_options.branch_id')
        ->select(
            'payment_options.id', 
            'b.description as branch',
            'payment_options.description',
            'payment_options.sales_report_excluded',
            'payment_options.seq_no');
    }

    public function scopeForDropdown($query,$branchId) {
        if ($branchId) {
            $query = $query->where('branch_id', $branchId);
        }
        return $query->select(
            'id', 
            'description')
            ->orderBy('seq_no');
    }
}
