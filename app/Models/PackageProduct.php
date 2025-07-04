<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageProduct extends Model
{
    use HasFactory, SoftDeletes;
    
    /* Relationships */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
