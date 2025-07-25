<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Patient extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $appends = ['full_name', 'age'];

    /* attributes */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }

    /* Relationships */
    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function queues()
    {
        return $this->hasMany(Queue::class);
    }

    /* Scopes */
    public function scopeActive($query, $branchId, $currentBranchId)
    {
        if ($branchId) {
            $query = $query->where('patients.branch_id', $branchId);
        }
        return $query
            ->join('branches as b', 'b.id', 'patients.branch_id')
            ->leftJoin('cities as c', 'c.id', 'patients.city_id')
            ->leftJoin('patient_available_credits as ac', function ($join) use ($currentBranchId) {
                $join->on('ac.patient_id', 'patients.id')
                    ->on('ac.branch_id', \DB::raw($currentBranchId ?? 0));
            })
            ->Select(
                'patients.id',
                \DB::raw("concat(patients.first_name, ' ', patients.last_name) as name"),
                'patients.code',
                'patients.address',
                'patients.mobile_number',
                'patients.birth_date',
                'patients.photo_ext',
                'patients.updated_at',
                'c.description as city',
                'b.description as branch',
                'ac.amount as available_credits'
            );
    }


    public function scopeForDropdown($query)
    {
        return $query->select('id', 'first_name', 'last_name', 'code', 'email')
            ->orderBy('first_name')
            ->orderBy('last_name');
    }
}
