<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueStatus extends Model
{
    use HasFactory;
    
    /* Scopes */
    public function scopeForDropdown($query,$branchId) {
        if ($branchId) {
            $query = $query->where('branch_id', $branchId);
        }
        return $query->select(
            'id', 
            'description', 
            'hex_color', 
            'branch_id');
    }
}
