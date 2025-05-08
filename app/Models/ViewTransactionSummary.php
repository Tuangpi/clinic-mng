<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewTransactionSummary extends Model
{
    use HasFactory;

    public $table = "view_transaction_summary";

    public function scopeActive($query, $branchId, $startDate, $endDate, $patient) {

        $filter = [];

        if ($startDate && $startDate) {
            $filter[] = "date between '{$startDate}' and '{$endDate}'";
        }

        if ($branchId) {
            $filter[] = "branch_id = {$branchId}";
        }

        if (count($patient) > 0) {
            $filter[] = "patient_id in (" . implode(",",$patient) . ")";
        }
        return $query->whereRaw(implode(" and ",$filter))->orderBy('time_in', 'asc');
    }
}
