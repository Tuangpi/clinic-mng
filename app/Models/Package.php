<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /* Scopes */
    public function scopeActive($query, $branchId, $typeId, $categoryId)
    {
        if ($branchId) {
            $query = $query->where('packages.branch_id', $branchId);
        }
        if ($typeId) {
            $query = $query->where('packages.product_type_id', $typeId);
        }
        if ($categoryId) {
            $query = $query->where('packages.product_category_id', $categoryId);
        }
        return $query
            ->join('branches as b', 'b.id', 'packages.branch_id')
            ->join('product_categories as c', 'c.id', 'packages.product_category_id')
            ->join('product_types as t', 't.id', 'packages.product_type_id')
            ->Select(
                'packages.id',
                'packages.code',
                'packages.name',
                'packages.selling_price',
                'packages.cost_price',
                'packages.session_count',
                'c.description as category',
                't.description as type',
                'b.description as branch',
                'b.currency_symbol',
            );
    }

    protected static function booted()
    {
        static::deleting(function ($package) {
            if (!$package->isForceDeleting()) {
                $package->packageProducts()->update(['deleted_at' => now()]);
            } else {
                $package->packageProducts()->forceDelete();
            }
        });
    }
}
