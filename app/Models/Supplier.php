<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    /* Scopes */
    public function scopeActive($query) {
        return $query
        ->leftJoin('cities as c', 'c.id', 'suppliers.city_id')
        ->Select(
            'suppliers.id',
            'suppliers.code',
            'suppliers.name',
            'suppliers.contact_person',
            'suppliers.mobile_number',
            'suppliers.tel_number',
            'suppliers.email',
            'c.description as city'
        );
    }

    public function scopeForDropdown($query, $isSupplier) {
        if ($isSupplier) {
            $query->where('is_supplier', true);
        }
        else {
            $query->where('is_manufacturer', true);
        }
        
        return $query->select(
            'id', 
            'name')
            ->orderBy('name');
    }
}
