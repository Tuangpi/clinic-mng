<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tax;
use DataTables;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tax::forDropdown();

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
            if ($request->schemeNo && Tax::where('code', $request->schemeNo)->exists()) {
                return response()->json(['errMsg' => 'Scheme No. already exists', 'isError' => true]);
            }

            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $t = new Tax;
            $t->created_by = $currentUserId;
            $t->updated_by = $currentUserId;

            $this->mapValues($t, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New tax scheme has been created.']);
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
            $t = Tax::find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['tax' => $t]);
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
            if ($request->schemeNo && Tax::where([
                ['code', $request->schemeNo],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Scheme No. already exists', 'isError' => true]);
            }

            \DB::beginTransaction();

            $t = Tax::find($id);
            $t->updated_by = \Auth::id();
            $this->mapValues($t, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Tax scheme has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $t = Tax::find($id);
        if ($t->purchaseOrders()->exists()) {
            return response()->json(['errMsg' => 'Unable to delete, this tax scheme is in use.', 'isError' => true]);
        }
        $t->forceDelete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    private function mapValues($t, $request)
    {
        $t->code = $request->schemeNo;
        $t->percentage = $request->percentage;
        $t->save();
    }
}
