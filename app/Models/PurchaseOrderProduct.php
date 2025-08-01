<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderProduct extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function deliveries()
    {
        return $this->hasMany(PurchaseOrderProductDelivery::class);
    }
}
