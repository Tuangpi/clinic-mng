<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    /* Relationships */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function appointmentCategory()
    {
        return $this->belongsTo(AppointmentCategory::class);
    }
    
    /* Scopes */
    public function scopeActive($query, $branchId) {
        if ($branchId) {
            $query = $query->where('appointments.branch_id', $branchId);
        }
        return $query
        ->leftJoin('patients as p', 'p.id', 'appointments.patient_id')
        ->join('appointment_categories as c', 'c.id', 'appointments.appointment_category_id')
        ->join('appointment_statuses as s', 's.id', 'appointments.appointment_status_id')
        ->leftJoin('recurring_types as rt', 'rt.id', 'appointments.recurring_type_id')
        ->join('branches as b', 'b.id', 'appointments.branch_id')
        ->Select(
            'appointments.id',
            'appointments.mobile_no',
            \DB::raw("concat(appointments.first_name, ' ', appointments.last_name) as guest"),
            \DB::raw("concat(p.first_name, ' ', p.last_name) as patient"),
            'appointments.start_date',
            'appointments.end_date',
            'c.description as category',
            's.description as status',
            'rt.description as recurring',
            'b.description as branch'
        );
    }

    public function scopeForCalendar($query, $branchId, $startDate, $endDate, $status, $category) {
        $startDate = Carbon::parse($startDate)->format('Y-m-d H:i');
        $endDate = Carbon::parse($endDate)->format('Y-m-d H:i');
        if ($branchId) {
            $query = $query->where('appointments.branch_id', $branchId);
        }
        if ($status != 'all') {
            $query = $query->whereIn('appointments.appointment_status_id', explode(',', $status));
        }
        if ($category != 'all') {
            $query = $query->whereIn('appointments.appointment_category_id', explode(',', $category));
        }
        return $query
        ->leftJoin('patients as p', 'p.id', 'appointments.patient_id')
        ->join('appointment_categories as ac', 'ac.id', 'appointments.appointment_category_id')
        ->join('appointment_statuses as as', 'as.id', 'appointments.appointment_status_id')
        ->leftJoin('recurring_types as rt', 'rt.id', 'appointments.recurring_type_id')
        ->join('branches as b', 'b.id', 'appointments.branch_id')
        ->where(function($query) use($startDate, $endDate) {
            $query->where(function($query) use($startDate, $endDate) {
                $query
                ->whereNull('appointments.recurring_end_date')
                ->where('appointments.start_date', '>=', $startDate)
                ->where('appointments.end_date', '<=', $endDate);
            })
            ->orWhere(function($query) use($startDate, $endDate) {
                $query
                ->whereNotNull('appointments.recurring_end_date')
                ->where('appointments.recurring_end_date', '>=', $startDate);
            });
        })
        ->Select(
            'appointments.id',
            'appointments.first_name as guest_first_name',
            'appointments.last_name as guest_last_name',
            'appointments.mobile_no as guest_mobile_no',
            'appointments.patient_id',
            'appointments.details',
            'appointments.appointment_category_id',
            'ac.description as category',
            'appointments.appointment_status_id',
            'as.description as status',
            'appointments.prefix',
            'p.code as patient_code',
            'p.first_name',
            'p.last_name',
            'appointments.start_date',
            'appointments.end_date',
            'ac.hex_color as category_color',
            'as.hex_color as status_color',
            'rt.description as recurring',
            'appointments.recurring_interval',
            'appointments.recurring_end_date',
            'appointments.recurring_dow',
            'b.description as branch',
            \DB::raw("case when exists (
                Select 1 from queues q 
                where q.deleted_at is null and
                q.patient_id = appointments.patient_id
                and q.is_draft = 0
            ) then 0 else 1 end as new_patient"),
        );
    }
}
