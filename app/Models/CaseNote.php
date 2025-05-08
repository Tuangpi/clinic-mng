<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseNote extends Model
{
    use HasFactory, SoftDeletes;
    
    
    /* Relationships */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function caseType()
    {
        return $this->belongsTo(CaseType::class);
    }

    /* Scopes */
    public function scopeByPatientAndCaseType($query, $patientId, $caseTypeId) {
        if ($caseTypeId) {
            $query = $query->where('case_type_id', $caseTypeId);
        }
        return $query->withTrashed()
        ->join('case_types as t', 't.id', 'case_notes.case_type_id')
        ->join('users as c', 'c.id', 'case_notes.created_by')
        ->where('case_notes.patient_id', $patientId)
        ->whereRaw('(case_notes.is_draft = 0 or (case_notes.is_draft = 1 and case_notes.deleted_at is null))')
        ->Select(
            'case_notes.id',
            'case_notes.no',
            'case_notes.case_date',
            'case_notes.content',
            'case_notes.is_draft',
            'case_notes.deleted_at',
            't.description as case_type',
            \DB::raw("(case_notes.created_by = " . \Auth::id() . ") as isCreator"),
            \DB::raw("concat(c.first_name, ' ', c.last_name) as created_by"),
        );

    }
}
