<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    /* Relationships */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function products()
    {
        return $this->hasMany(PurchaseOrderProduct::class);
    }

    public function payments()
    {
        return $this->hasMany(PurchaseOrderPayment::class);
    }

    public function deliveries()
    {
        return $this->hasManyThrough(PurchaseOrderProductDelivery::class, PurchaseOrderProduct::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /* Scopes */
    public function scopeDeliveryReport($query, $branchId, $startDate, $endDate, $supplierIds, $deliveryStatus) {
        if ($branchId) {
            $query = $query->where('purchase_orders.branch_id', $branchId);
        }
        if ($startDate && $endDate) {
            $query = $query->whereBetween('purchase_orders.order_date', [$startDate, $endDate]);
        }
        else {
            $query = $query->whereYear('purchase_orders.order_date', \Carbon::now()->format('Y'));
        }
        if ($supplierIds) {
            $query = $query->whereIn('purchase_orders.supplier_id', $supplierIds);
        }
        if ($deliveryStatus != '') {
            $query = $query->where('purchase_orders.is_delivery_completed', $deliveryStatus);
        }
        return $query
        ->join('branches as b', 'b.id', 'purchase_orders.branch_id')
        ->join('suppliers as s', 's.id', 'purchase_orders.supplier_id')
        ->join('users as c', 'c.id', 'purchase_orders.created_by')
        ->Select(
            'purchase_orders.code',
            'purchase_orders.order_date',
            'purchase_orders.po_no',
            'purchase_orders.is_delivery_completed',
            \DB::raw("(Select count(1) from purchase_order_products as pop 
                        where pop.purchase_order_id = purchase_orders.id and pop.deleted_at is null) as item_count"),
            's.name as supplier',
            'b.description as branch',
            \DB::raw("concat(c.first_name, ' ', c.last_name) as created_by")
        );
    }

    public function scopeActive($query, $branchId, $startDate, $endDate, $supplierId, $paymentStatus, $deliveryStatus) {
        if ($branchId) {
            $query = $query->where('purchase_orders.branch_id', $branchId);
        }
        if ($startDate && $endDate) {
            $query = $query->whereBetween('purchase_orders.order_date', [$startDate, $endDate]);
        }
        else {
            $query = $query->whereYear('purchase_orders.order_date', \Carbon::now()->format('Y'));
        }
        if ($supplierId) {
            $query = $query->where('purchase_orders.supplier_id', $supplierId);
        }
        if ($paymentStatus) {
            switch ($paymentStatus) {
                case 'No Payment':
                    $query = $query->where('purchase_orders.paid_amount', 0);
                    break;
                case 'Partial Payment':
                    $query = $query->where([
                        ['purchase_orders.is_fully_paid', false],
                        ['purchase_orders.paid_amount', '>', 0]]);
                    break;
                case 'Fully Paid':
                    $query = $query->where('purchase_orders.is_fully_paid', true);
                    break;
            }
        }
        if ($deliveryStatus != '') {
            $query = $query->where('purchase_orders.is_delivery_completed', $deliveryStatus);
        }
        return $query
        ->join('branches as b', 'b.id', 'purchase_orders.branch_id')
        ->join('suppliers as s', 's.id', 'purchase_orders.supplier_id')
        ->Select(
            'purchase_orders.id',
            'purchase_orders.code',
            'purchase_orders.order_date',
            'purchase_orders.po_no',
            'purchase_orders.total_amount',
            'purchase_orders.paid_amount',
            'purchase_orders.is_fully_paid',
            'purchase_orders.is_delivery_completed',
            \DB::raw("(Select count(1) from purchase_order_products as pop 
                        where pop.purchase_order_id = purchase_orders.id and pop.deleted_at is null) as item_count"),
            \DB::raw("(
                select
                group_concat(
                    pop.invoice_no
                        SEPARATOR ', ') as products
                from purchase_order_payments pop
                where pop.deleted_at is null and pop.purchase_order_id = purchase_orders.id
            ) as invoice_no"),
            \DB::raw("(not exists(Select 1
            from purchase_order_product_deliveries as popd
            join purchase_order_products as pop on pop.id = popd.purchase_order_product_id
            where pop.purchase_order_id = purchase_orders.id and pop.deleted_at is null and
            popd.deleted_at is null) and
            not exists(Select 1
            from purchase_order_payments as pop
            where pop.purchase_order_id = purchase_orders.id and pop.deleted_at is null)) as can_edit"),
            's.name as supplier',
            'b.description as branch',
            'b.currency_symbol'
        );
    }
}
