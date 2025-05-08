<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewQueueItem extends Model
{
    use HasFactory;

    public $table = "view_queue_items";

    public function scopeActive($query, $branchId, $type, $category) {

        $filter = '';

        if ($type) {
            $filter .= " and product_type_id = {$type}";
        }
        if ($category) {
            $filter .= " and product_category_id = {$category}";
        }
       
        return $query->whereRaw(
                    "
                    branch_id = {$branchId}{$filter}
                    ");
    }
}
