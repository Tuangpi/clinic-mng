<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    public function products() {
        return $this->hasMany(Product::class);
    }   
    
    public function packages() {
        return $this->hasMany(Package::class);
    }
    
    /* Scopes */
    public function scopeForDropdown($query) {
        
        return $query->select(
            'id', 
            'description')
            ->orderBy('description');
    }
}
