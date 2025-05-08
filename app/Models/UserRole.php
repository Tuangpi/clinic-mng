<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use HasFactory, SoftDeletes;

    /* Relationships */
    public function users() {
        return $this->hasMany(User::class);
    }

    public function modules() {
        return $this->belongsToMany(Module::class)->withTimestamps();
    }

    /* Scopes */
    public function scopeActive($query) {
        return $query
        ->Select(
            'id',
            'description',
            'is_system_default'
        );
    }
}
