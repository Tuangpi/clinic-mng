<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaseNoteFile;

use DataTables;

class CaseNoteFileController extends Controller
{
    public function index(Request $request, $caseNoteId)
    {
        if ($request->ajax()) {
            $data = CaseNoteFile::byCaseNote($caseNoteId);

            return Datatables::of($data)
                ->filterColumn('created_by', function ($query, $keyword) {
                    $query->whereRaw("concat(c.first_name, ' ', c.last_name) like ?", ["%{$keyword}%"]);
                })
                ->make(true);
        }
    }

    public function destroy($caseNoteId, $id)
    {
        $cnf = CaseNoteFile::find($id);
        $cnf->forceDelete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    public function download($name)
    {
        $file = CaseNoteFile::where('name', $name)->first();
        return \Storage::download('case-note-files/' . $name, $file->original_name);
    }

    public function upload(Request $request, $caseNoteId)
    {
        foreach ($request->file as $file) {
            $name = $file->store('case-note-files');

            $cnf = new CaseNoteFile;
            $cnf->branch_id = session('branch')->id;
            $cnf->case_note_id = $caseNoteId;
            $cnf->created_by = \Auth::id();
            $cnf->size = $file->getSize();
            $cnf->original_name = $file->getClientOriginalName();
            $cnf->name = basename($name);

            $cnf->save();
        }

        return response()->json(['success' => 'true']);
    }
}
