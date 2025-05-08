<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use App\Models\Branch;
use App\Enums\UserRole as UserRoleEnum;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['full_name'];

    /* Relationships */
    public function branches() {
        return $this->belongsToMany(Branch::class)->withTimestamps();
    }

    public function userRole() {
        return $this->belongsTo(UserRole::class);
    }
    
    public function nationality() {
        return $this->belongsTo(Nationality::class);
    }

    /* attributes */
    public function getIsAdministratorAttribute() {
        return $this->attributes['user_role_id'] == UserRoleEnum::Administrator;
    }
    

    public function getPhotoUrlAttribute()
    {
        if (!empty($this->attributes['photo_ext'])) {
            $url = \Storage::disk('public')->url('user-profile/' . $this->attributes['id'] . '.' . $this->attributes['photo_ext'] . '?v=' . Carbon::parse($this->attributes['updated_at'])->format('dmYHiss'));
        }
        else {
            $url = asset('/assets/images/new-user.png');
        }
        return $url;
    }
    
    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    /* Scopes */
    public function scopeHasAccess($query, $module)
    {
        return $this->is_administrator || (!$this->is_administrator && !$this->userRole->modules->where('name', $module)->isEmpty());
    }

    public function scopeHasCreatedUpdatedRecord($query, $id)
    {
        return $query->where('id', $id)
                ->whereRaw("(
                    exists(Select 1 from appointment_categories where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from appointment_statuses where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from appointments where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from branch_user where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from branches where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from case_note_comments where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from case_note_files where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from case_notes where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from case_types where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from cities where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from dosages where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from failed_jobs where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from frequencies where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from genders where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from incomplete_transactions where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from marital_statuses where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from migrations where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from nationalities where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from package_products where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from packages where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from password_resets where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from patient_available_credits where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from patient_credits where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from patients where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from payment_options where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from personal_access_tokens where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from product_categories where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from product_types where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from products where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from purchase_order_files where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from purchase_order_payments where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from purchase_order_product_deliveries where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from purchase_order_products where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from purchase_orders where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from queue_outside_prescription_medicines where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from queue_outside_prescriptions where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from queue_payments where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from queue_statuses where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from queue_transaction_products where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from queue_transactions where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from queues where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from recurring_types where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from states where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from stock_adjustment_products where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from stock_adjustment_types where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from stock_adjustments where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from suppliers where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from taxes where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from titles where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from uoms where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from usages where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from user_roles where created_by = users.id or updated_by = users.id) or
                    exists(Select 1 from users where created_by = users.id or updated_by = users.id)
                )")
                ->Select(\DB::raw(1));
    }
    public function scopeActive($query) {
        return $query
        ->join('user_roles as r', 'r.id', 'users.user_role_id')
        ->Select(
            'users.id',
            'users.code',
            'users.username',
            \DB::raw("concat(users.first_name, ' ', users.last_name) as name"),
            'users.email',
            'users.mobile_number',
            'users.is_active',
            'users.photo_ext',
            'users.updated_at',
            'r.description as role'
        );
    }
}
