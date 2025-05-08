<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseType extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    public function caseNotes()
    {
        return $this->hasMany(CaseNote::class);
    }

    /* Scopes */
    public function scopeForDropdown($query) {
        
        return $query->select(
            'id', 
            'description')
            ->orderBy('description');
    }
}
