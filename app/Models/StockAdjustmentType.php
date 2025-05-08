<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAdjustmentType extends Model
{
    use HasFactory;
    
    /* Scopes */
    public function scopeForDropdown($query) {
        
        return $query->select(
            'id', 
            'description')
            ->orderBy('seq_no');
    }
}
