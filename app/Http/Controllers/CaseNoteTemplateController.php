<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaseNoteTemplate;
use DataTables;

class CaseNoteTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CaseNoteTemplate::forDropdown();

            return Datatables::of($data)
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request->description && CaseNoteTemplate::where('name', $request->name)->exists()) {
                return response()->json(['errMsg' => 'Name already exists', 'isError' => true]);
            }

            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $ct = new CaseNoteTemplate;
            $ct->created_by = $currentUserId;
            $ct->updated_by = $currentUserId;

            $this->mapValues($ct, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New Case Note Template has been created.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $ct = CaseNoteTemplate::find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['caseNoteTemplate' => $ct]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if ($request->name && CaseNoteTemplate::where([
                ['name', $request->name],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Name already exists', 'isError' => true]);
            }

            \DB::beginTransaction();

            $ct = CaseNoteTemplate::find($id);
            $ct->updated_by = \Auth::id();
            $this->mapValues($ct, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Case Note Template has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ct = CaseNoteTemplate::find($id);
        $ct->delete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    public function getDescription($id)
    {
        try {
            $ct = CaseNoteTemplate::find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['description' => $ct->description]);
    }

    private function mapValues($ct, $request)
    {
        $ct->name = $request->name;
        $ct->description = $request->description;
        $ct->save();
    }
}
