<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseNoteComment extends Model
{
    use HasFactory,SoftDeletes;

    /* Scopes */
    public function scopeByCaseNote($query, $caseNoteId) {
        return $query
        ->join('users as u', 'u.id', 'case_note_comments.user_id')
        ->where('case_note_comments.case_note_id', $caseNoteId)
        ->Select(
            'case_note_comments.id',
            'case_note_comments.user_id',
            'case_note_comments.message',
            'case_note_comments.created_at',
            'u.photo_ext as user_photo_ext',
            'u.updated_at as user_updated_at',
            \DB::raw("(case_note_comments.user_id = " . \Auth::id() . ") as isCreator"),
            \DB::raw("concat(u.first_name, ' ', u.last_name) as user")
        );

    }
}
