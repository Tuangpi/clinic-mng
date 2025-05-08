<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentCategory extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    public function appointments() {
        return $this->hasMany(Appointment::class);
    }

    /* Scopes */
    public function scopeForDropdown($query,$branchId) {
        if ($branchId) {
            $query = $query->where('branch_id', $branchId);
        }
        return $query->join('branches as b', 'b.id', 'appointment_categories.branch_id')
                ->select('appointment_categories.id', 
                'appointment_categories.description', 
                'appointment_categories.hex_color', 
                'appointment_categories.seq_no', 
                'b.description as branch')
                ->orderBy('appointment_categories.seq_no');
    }
}
