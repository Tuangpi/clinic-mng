<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\State;
use DataTables;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Branch::active();

            return Datatables::of($data)
                ->filterColumn('city', function ($query, $keyword) {
                    $query->whereRaw("c.description like ?", ["%{$keyword}%"]);
                })
                ->make(true);
        }
        $states = State::orderBy('description')->get();

        return view('general-setup/branches', compact('states'));
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
            if ($request->description && Branch::where('description', $request->description)->exists()) {
                return response()->json(['errMsg' => 'Description already exists', 'isError' => true]);
            }

            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $b = new Branch;
            $b->created_by = $currentUserId;
            $b->updated_by = $currentUserId;

            $this->mapValues($b, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New branch has been created.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $b = Branch::with([
                'city:id,description,state_id',
                'city.state:id,description'
            ])->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['branch' => $b]);
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
            $b = Branch::with('city:id,state_id')->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['branch' => $b]);
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
            if ($request->description && Branch::where([
                ['description', $request->description],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Description already exists', 'isError' => true]);
            }

            \DB::beginTransaction();

            $b = Branch::find($id);
            $b->updated_by = \Auth::id();
            $this->mapValues($b, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Branch has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $b = Branch::find($id);
        if (Branch::hasCreatedUpdatedRecord($id)->exists()) {
            return response()->json(['errMsg' => 'Unable to delete, this branch is in use.', 'isError' => true]);
        }
        $b->delete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    public function switch($id)
    {
        $user = \Auth::user();
        if ($id == 0) {
            if (!$user->is_administrator) {
                return back();
            }
            $branch = null;
        } else {
            if (!$user->is_administrator && !$user->branches()->where('branch_id', $id)->exists()) {
                return back();
            }
            $branch = Branch::find($id);
        }
        session(['branch' => $branch]);
        return back();
    }

    private function mapValues($b, $request)
    {
        $b->code = $request->branchId;
        $b->description = $request->name;
        $b->address = $request->address;
        $b->tel_no = $request->telNo;
        $b->print_header = $request->printHeader;
        $b->currency_symbol = $request->currencySymbol;
        $b->co_reg_no = $request->coRegNo;
        $b->co_reg_no = $request->coRegNo;
        $b->city_id = $request->city;
        $b->zip_code = $request->zipCode;
        $b->is_active = $request->status;
        $b->save();
    }
}
