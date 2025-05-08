<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
    
    /* Scopes */
    public function scopeForDropdown($query) {
        
        return $query->select(
            'id', 
            'code',
            'percentage');
    }
}
