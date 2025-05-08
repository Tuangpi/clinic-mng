<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewTransactionSummaryPaymentModeWithoutExcluded extends Model
{
    use HasFactory;

    public $table = "view_transaction_summary_payment_modes_without_excluded";

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

        return $query->whereRaw(implode(" and ",$filter))
                 ->selectRaw('mode, currency_symbol, sum(amount) as amount')
                ->groupBy('mode', 'currency_symbol');
    }
}
