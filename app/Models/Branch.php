<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    /* Relationships */
    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    /* Scopes */
    public function scopeHasCreatedUpdatedRecord($query, $id)
    {
        return $query->where('id', $id)
                ->whereRaw("(
                    exists(Select 1 from appointment_categories where branch_id = branches.id) or
                    exists(Select 1 from appointments where branch_id = branches.id) or
                    exists(Select 1 from branch_user where branch_id = branches.id) or
                    exists(Select 1 from case_note_comments where branch_id = branches.id) or
                    exists(Select 1 from case_note_files where branch_id = branches.id) or
                    exists(Select 1 from case_notes where branch_id = branches.id) or
                    exists(Select 1 from packages where branch_id = branches.id) or
                    exists(Select 1 from patient_available_credits where branch_id = branches.id) or
                    exists(Select 1 from patient_credits where branch_id = branches.id) or
                    exists(Select 1 from patients where branch_id = branches.id) or
                    exists(Select 1 from payment_options where branch_id = branches.id) or
                    exists(Select 1 from products where branch_id = branches.id) or
                    exists(Select 1 from purchase_orders where branch_id = branches.id) or
                    exists(Select 1 from queue_statuses where branch_id = branches.id) or
                    exists(Select 1 from queues where branch_id = branches.id) or
                    exists(Select 1 from stock_adjustments where branch_id = branches.id)
                )")
                ->Select(\DB::raw(1));
    }

    public function scopeActive($query) {
        return $query
        ->leftJoin('cities as c', 'c.id', 'branches.city_id')
        ->Select(
            'branches.id',
            'branches.code',
            'branches.description',
            'branches.tel_no',
            'c.description as city',
            'branches.is_active'
        );
    }

    public function scopeForDropdown($query, $excludeSelf) {
        
        if ($excludeSelf) {
            $query = $query->where('id', '!=', session('branch')->id);
        }

        return $query->select(
            'id', 
            'description')
            ->orderBy('description');
    }
}
