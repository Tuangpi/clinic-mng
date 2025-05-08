<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseNoteTemplate extends Model
{
    use HasFactory, SoftDeletes;

    /* Scopes */
    public function scopeForDropdown($query) {
        
        return $query->select(
            'id', 
            'name')
            ->orderBy('name');
    }
}
