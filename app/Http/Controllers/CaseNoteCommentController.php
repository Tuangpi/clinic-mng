<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\CaseNoteComment;

class CaseNoteCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $caseNoteId)
    {
        if ($request->ajax()) {
            $comments = CaseNoteComment::byCaseNote($caseNoteId)->get();
            return response()->json(['comments' => $comments]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $caseNoteId)
    {
        try {

            $currentBranch = session('branch');
            \DB::beginTransaction();

            $cnc = new CaseNoteComment;
            $cnc->branch_id = $currentBranch->id;
            $cnc->case_note_id = $caseNoteId;
            $cnc->user_id = \Auth::id();
            $cnc->message = $request->message;
            $cnc->save();

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New comment has been saved.', 'id' => $cnc->id, 'commentDate' => $cnc->created_at]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($caseNoteId, $id)
    {
        $cnc = CaseNoteComment::find($id);
        $cnc->delete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }
}
