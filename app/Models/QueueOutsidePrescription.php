<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QueueOutsidePrescription extends Model
{
    use HasFactory, SoftDeletes;

    /* Relationships */
    public function medicines()
    {
        return $this->hasMany(QueueOutsidePrescriptionMedicine::class);
    }
    
    /* Scopes */
    public function scopeByQueue($query, $queueId) {
     
        return $query->withTrashed()
        ->join('users as c', 'c.id', 'queue_outside_prescriptions.created_by')
        ->where('queue_outside_prescriptions.queue_id', $queueId)
        ->whereRaw('(queue_outside_prescriptions.is_draft = 0 or (queue_outside_prescriptions.is_draft = 1 and queue_outside_prescriptions.deleted_at is null))')
        ->Select(
            'queue_outside_prescriptions.id',
            'queue_outside_prescriptions.created_at',
            'queue_outside_prescriptions.is_draft',
            'queue_outside_prescriptions.deleted_at',
            \DB::raw("(queue_outside_prescriptions.created_by = " . \Auth::id() . ") as isCreator"),
            \DB::raw("concat(c.first_name, ' ', c.last_name) as created_by"),
            \DB::raw("(
                select 
                group_concat(
                concat(
                qopm.description,'#brCol#',
                qopm.dosage,'#brCol#',
                qopm.remarks)
                SEPARATOR '#newRow#')
                from queue_outside_prescription_medicines qopm
                where qopm.queue_outside_prescription_id = queue_outside_prescriptions.id and qopm.deleted_at is null
            ) as medicines")
        );

    }
}
