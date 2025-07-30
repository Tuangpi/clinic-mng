<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentStatus;
use DataTables;

class AppointmentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = AppointmentStatus::forDropdown();

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
            if ($request->description && AppointmentStatus::where('description', $request->description)->exists()) {
                return response()->json(['errMsg' => 'Status already exists', 'isError' => true]);
            }

            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $as = new AppointmentStatus;
            $as->created_by = $currentUserId;
            $as->updated_by = $currentUserId;

            $this->mapValues($as, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New Status has been created.']);
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
            $as = AppointmentStatus::find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['status' => $as]);
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
            $currentBranch = session('branch');

            if ($request->description && AppointmentStatus::where([
                ['description', $request->description],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Description already exists', 'isError' => true]);
            }

            \DB::beginTransaction();

            $as = AppointmentStatus::find($id);
            $as->updated_by = \Auth::id();
            $this->mapValues($as, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Status has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $as = AppointmentStatus::find($id);
        if ($as->appointments()->exists()) {
            return response()->json(['errMsg' => 'Unable to delete, this status is in use.', 'isError' => true]);
        }
        $as->delete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    private function mapValues($as, $request)
    {
        $as->description = $request->description;
        $as->seq_no = $request->seqNo;
        $as->hex_color = $request->color;
        $as->save();
    }
}
