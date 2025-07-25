<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CaseType;
use DataTables;

class CaseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CaseType::forDropdown();

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
            if ($request->description && CaseType::where('description', $request->description)->exists()) {
                return response()->json(['errMsg' => 'Description already exists', 'isError' => true]);
            }

            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $ct = new CaseType;
            $ct->created_by = $currentUserId;
            $ct->updated_by = $currentUserId;

            $this->mapValues($ct, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New Case Type has been created.']);
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
            $ct = CaseType::find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['data' => $ct]);
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
            if ($request->description && CaseType::where([
                ['description', $request->description],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Description already exists', 'isError' => true]);
            }

            \DB::beginTransaction();

            $ct = CaseType::find($id);
            $ct->updated_by = \Auth::id();
            $this->mapValues($ct, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Case Type has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ct = CaseType::find($id);
        if ($ct->caseNotes()->exists()) {
            return response()->json(['errMsg' => 'Unable to delete, this case type is in use.', 'isError' => true]);
        }
        $ct->forceDelete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    private function mapValues($ct, $request)
    {
        $ct->description = $request->description;
        $ct->save();
    }
}
