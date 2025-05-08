<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Uom extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    public function products() {
        return $this->hasMany(Product::class);
    }   

    public function productDosages() {
        return $this->hasMany(Product::class, 'dosage_uom_id');
    }   
    
    public function queueTransactionDosages() {
        return $this->hasMany(QueueTransaction::class, 'dosage_uom_id');
    }
    
    public function queueTransactionProductDosages() {
        return $this->hasMany(QueueTransactionProduct::class, 'dosage_uom_id');
    }
    
    /* Scopes */
    public function scopeForDropdown($query) {
        
        return $query->select(
            'id', 
            'description')
            ->orderBy('description');
    }
}
