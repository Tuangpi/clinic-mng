<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\CaseNote;
use App\Models\CaseNoteFile;
use DataTables;

class CaseNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $patientId)
    {
        if ($request->ajax()) {
            $data = CaseNote::byPatientAndCaseType($patientId, $request->case_type);

            return Datatables::of($data)
                ->filterColumn('created_by', function ($query, $keyword) {
                    $query->whereRaw("concat(c.first_name, ' ', c.last_name) like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('case_type', function ($query, $keyword) {
                    $query->whereRaw("t.description like ?", ["%{$keyword}%"]);
                })
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $patientId)
    {
        try {

            $currentBranch = session('branch');
            \DB::beginTransaction();

            $cn = new CaseNote;
            $cn->branch_id = $currentBranch->id;
            $cn->patient_id = $patientId;
            $cn->created_by = \Auth::id();
            $cn->updated_by = \Auth::id();
            $this->mapValues($cn, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New case note has been created.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($patientId, $id)
    {
        try {
            $cn = CaseNote::with([
                'creator:id,first_name,last_name,photo_ext,updated_at',
                'caseType:id,description'
            ])
                ->withTrashed()
                ->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['caseNote' => $cn]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($patientId, $id)
    {
        try {
            $cn = CaseNote::find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['caseNote' => $cn]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $patientId, $id)
    {
        try {

            \DB::beginTransaction();

            $cn = CaseNote::find($id);
            $cn->updated_by = \Auth::id();
            $this->mapValues($cn, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Case note has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($patientId, $id)
    {
        $cn = CaseNote::find($id);
        $cn->forceDelete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    public function revert($patientId, $id)
    {
        $cn = CaseNote::withTrashed()->find($id);
        $cn->restore();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    private function mapValues($cn, $request)
    {
        $cn->case_type_id = $request->caseType;
        $cn->case_date = Carbon::parse($request->caseDate);
        $cn->content = $request->content;
        $cn->is_draft = $request->isDraft;

        $cn->save();

        $cn->no = ($cn->is_draft ? 'D' : 'C') . '-' . sprintf('%05d', $cn->id);

        $cn->save();

        if ($request->attachments) {
            foreach ($request->attachments as $file) {
                $name = $file->store('case-note-files');

                $cnf = new CaseNoteFile;
                $cnf->branch_id = $cn->branch_id;
                $cnf->case_note_id = $cn->id;
                $cnf->created_by = \Auth::id();
                $cnf->size = $file->getSize();
                $cnf->original_name = $file->getClientOriginalName();
                $cnf->name = basename($name);

                $cnf->save();
            }
        }
    }
}
