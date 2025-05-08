<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderFile extends Model
{
    use HasFactory, SoftDeletes;

    /* Scopes */
    public function scopeByOrder($query, $orderId) {
        return $query
        ->join('users as c', 'c.id', 'purchase_order_files.created_by')
        ->where('purchase_order_files.purchase_order_id', $orderId)
        ->Select(
            'purchase_order_files.id',
            'purchase_order_files.original_name',
            'purchase_order_files.name',
            'purchase_order_files.size',
            'purchase_order_files.created_at',
            \DB::raw("concat(c.first_name, ' ', c.last_name) as created_by")
        );

    }
}
