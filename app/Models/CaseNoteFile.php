<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseNoteFile extends Model
{
    use HasFactory, SoftDeletes;

    /* Scopes */
    public function scopeByCaseNote($query, $caseNoteId) {
        return $query
        ->join('users as c', 'c.id', 'case_note_files.created_by')
        ->where('case_note_files.case_note_id', $caseNoteId)
        ->Select(
            'case_note_files.id',
            'case_note_files.original_name',
            'case_note_files.name',
            'case_note_files.size',
            'case_note_files.created_at',
            \DB::raw("concat(c.first_name, ' ', c.last_name) as created_by")
        );

    }
}
