<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentStatus extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
    
    /* Scopes */
    public function scopeForDropdown($query) {
        return $query->select('id', 'description', 'hex_color', 'seq_no')
                ->orderBy('seq_no');
    }
}
