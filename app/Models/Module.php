<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    /* Relationships */
    public function userRoles() {
        return $this->belongsToMany(UserRole::class)->withTimestamps();
    }
}
