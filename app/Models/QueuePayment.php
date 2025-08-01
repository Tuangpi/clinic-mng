<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QueuePayment extends Model
{
    use HasFactory, SoftDeletes;

    /* Relationships */
    public function paymentOption()
    {
        return $this->belongsTo(PaymentOption::class);
    }
}
