<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    public function packageProducts()
    {
        return $this->hasMany(PackageProduct::class);
    }

    public function transactions()
    {
        return $this->hasMany(QueueTransaction::class);
    }
    
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }
    
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
    
    public function uom()
    {
        return $this->belongsTo(Uom::class);
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
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    
    public function manufacturer()
    {
        return $this->belongsTo(Supplier::class);
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
    public function scopeWithStockForDropdown($query, $branchId) {
        return $query
        ->join('uoms as u', 'u.id', 'products.uom_id')
        ->where('branch_id', $branchId)
        ->where('is_stock_unlimited', false)
        ->Select(
            'products.id',
            'products.code',
            'products.name',
            'u.description as uom',
            'products.current_stock',
            'products.cost_price',
            'products.is_stock_unlimited',
            'products.is_active'
        )
        ->orderBy('name');
    }

    public function scopeForDropdown($query, $branchId) {
        return $query
        ->where('branch_id', $branchId)
        ->Select(
            'id',
            'code',
            'name',
            'is_stock_unlimited',
            'is_active'
        )
        ->orderBy('name');
    }

    public function scopeCritical($query, $branchId) {
        if ($branchId) {
            $query = $query->where('products.branch_id', $branchId);
        }
        return $query
            ->where('is_stock_unlimited', false)
            ->whereRaw('critical_level > current_stock');
    }
    
    public function scopeActive($query, $branchId, $typeId, $categoryId, $critical) {
        if ($branchId) {
            $query = $query->where('products.branch_id', $branchId);
        }
        if ($typeId) {
            $query = $query->where('products.product_type_id', $typeId);
        }
        if ($categoryId) {
            $query = $query->where('products.product_category_id', $categoryId);
        }
        if ($critical != '') {
            if ($critical == '1') {
                $query = $query->whereRaw('products.current_stock < products.critical_level');
            } else {
                $query = $query->whereRaw('products.current_stock >= products.critical_level');
            }
            
        }
        return $query
        ->join('branches as b', 'b.id', 'products.branch_id')
        ->join('uoms as u', 'u.id', 'products.uom_id')
        ->join('product_categories as c', 'c.id', 'products.product_category_id')
        ->join('product_types as t', 't.id', 'products.product_type_id')
        ->Select(
            'products.id',
            'products.code',
            'products.name',
            'products.selling_price',
            'products.cost_price',
            'products.current_stock',
            'products.critical_level',
            'products.is_stock_unlimited',
            'products.is_active',
            'u.description as uom',
            'c.description as category',
            't.description as type',
            'b.description as branch',
            'b.currency_symbol'
        );
    }
}
