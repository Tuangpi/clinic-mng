<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewCreditTransaction extends Model
{
    use HasFactory;

    public $table = "view_credit_transactions";

    public function scopeActive($query, $patientId, $branchId) {
       
        return $query->whereRaw("patient_id = {$patientId} and branch_id = {$branchId}");
    }
}
