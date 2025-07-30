<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentCategory;
use DataTables;

class AppointmentCategoryController extends Controller
{

    public function calendar(Request $request)
    {
        $currentBranch = session('branch');
        $categories = AppointmentCategory::select('id', 'description as title')->orderBy('seq_no');

        if ($currentBranch) {
            $categories = $categories->where('branch_id', $currentBranch->id);
        }

        $categories = $categories->get();
        return response()->json($categories);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $currentBranch = session('branch');
            $data = AppointmentCategory::forDropdown($currentBranch->id ?? null);

            return Datatables::of($data)
                ->filterColumn('branch', function ($query, $keyword) {
                    $query->whereRaw("b.description like ?", ["%{$keyword}%"]);
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
    public function store(Request $request)
    {
        try {
            $currentBranch = session('branch');

            if ($request->description && AppointmentCategory::where([
                ['description', $request->description],
                ['branch_id', $currentBranch->id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Category already exists', 'isError' => true]);
            }

            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $ac = new AppointmentCategory;
            $ac->branch_id = $currentBranch->id;
            $ac->created_by = $currentUserId;
            $ac->updated_by = $currentUserId;

            $this->mapValues($ac, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New category has been created.']);
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
            $ac = AppointmentCategory::find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['category' => $ac]);
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

            if ($request->description && AppointmentCategory::where([
                ['description', $request->description],
                ['branch_id', $currentBranch->id],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Description already exists', 'isError' => true]);
            }

            \DB::beginTransaction();

            $ac = AppointmentCategory::find($id);
            $ac->updated_by = \Auth::id();
            $this->mapValues($ac, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Category has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ac = AppointmentCategory::find($id);
        if ($ac->appointments()->exists()) {
            return response()->json(['errMsg' => 'Unable to delete, this category is in use.', 'isError' => true]);
        }
        $ac->delete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    private function mapValues($ac, $request)
    {
        $ac->description = $request->description;
        $ac->seq_no = $request->seqNo;
        $ac->hex_color = $request->color;
        $ac->save();
    }
}
