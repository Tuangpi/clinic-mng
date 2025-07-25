<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserRole;
use DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UserRole::active();

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
            if ($request->description && UserRole::where('description', $request->description)->exists()) {
                return response()->json(['errMsg' => 'Description already exists', 'isError' => true]);
            }

            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $r = new UserRole;
            $r->created_by = $currentUserId;
            $r->updated_by = $currentUserId;

            $this->mapValues($r, $request);


            if (!empty($request->module)) {
                $r->modules()->attach($request->module);
            }

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        $roles = UserRole::select('id', 'description as text')->orderBy('description')->get();
        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New role has been created.', 'roles' => $roles]);
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
            $r = UserRole::with('modules:id,id')->find($id);
            $r->module_ids = collect($r->modules)->pluck('id');
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['role' => $r]);
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
            if ($request->description && UserRole::where([
                ['description', $request->description],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Description already exists', 'isError' => true]);
            }

            \DB::beginTransaction();

            $r = UserRole::find($id);
            $r->updated_by = \Auth::id();
            $this->mapValues($r, $request);

            if (!empty($request->module)) {
                $r->modules()->sync($request->module);
            } else {
                $r->modules()->detach();
            }

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        $roles = UserRole::select('id', 'description as text')->orderBy('description')->get();
        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Role has been updated.', 'roles' => $roles]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $r = UserRole::find($id);
        if ($r->users()->exists()) {
            return response()->json(['errMsg' => 'Unable to delete, this role is in use.', 'isError' => true]);
        }
        $r->forceDelete();
        $roles = UserRole::select('id', 'description as text')->orderBy('description')->get();
        return response()->json(['errMsg' => '', 'isError' => false, 'roles' => $roles]);
    }

    private function mapValues($r, $request)
    {
        $r->description = $request->description;
        $r->save();
    }
}
