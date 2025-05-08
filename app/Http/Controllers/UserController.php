<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Branch;
use App\Models\Nationality;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::active();
                
            return Datatables::of($data)
            ->filterColumn('role', function($query, $keyword) {
                $query->whereRaw("r.description like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('branch', function($query, $keyword) {
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
            if ($request->email && User::where('email', $request->email)->exists()) {
                return response()->json(['errMsg'=> 'Email already exists', 'isError'=> true]);
            }
            
            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $u = new User;
            $u->created_by = $currentUserId;
            $u->updated_by = $currentUserId;
            $u->password = \Hash::make($request->password);

            $this->mapValues($u, $request);

            if (!empty($request->branch) && !$u->is_administrator) {
                $u->branches()->attach($request->branch);
            }
            
            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false, 'message' => 'New user has been created.']);
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
            $u = User::with([
                'userRole:id,description',
                'nationality:id,description',
                'branches:id,description'
                ])->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
        }
        return response()->json(['user' => $u]);
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
            $u = User::with('branches:id,id')->find($id);
            $u->branch_ids = collect($u->branches)->pluck('id');
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
        }
        return response()->json(['user' => $u]);
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
            if ($request->email && User::where([
                ['email', $request->email],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg'=> 'Email already exists', 'isError'=> true]);
            }
            
            \DB::beginTransaction();

            $u = User::find($id);
            $u->updated_by = \Auth::id();
            $this->mapValues($u, $request);
           
            if ($u->is_administrator) {
                $u->branches()->detach();
            } else {
                $u->branches()->sync($request->branch);
            }
            

            
            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false, 'message' => 'User has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u = User::find($id);
        if (User::hasCreatedUpdatedRecord($id)->exists()) {
            return response()->json(['errMsg'=> 'Unable to delete, this user has already created/updated a record.', 'isError'=> true]);
        }
        $u->delete();
        return response()->json(['errMsg'=> '', 'isError'=> false]);
    }

    public function changePassword()
    {
        return view('change-password');
    }

    public function updatePassword(Request $request)
    {
        $user = \Auth::user();
        
        if (\Hash::check($request->currentPassword, $user->password)) {
            
            $user->password = \Hash::make($request->newPassword);
            $user->save();
            \Auth::guard()->login(\Auth::user());
        }
        else {
            return response()->json(['errMsg'=> 'Incorrect current password.', 'isError'=> true]);
        }
        return response()->json(['errMsg'=> '', 'isError'=> false]);
    }

    private function mapValues($u, $request)
    {
        $u->first_name = $request->firstName;
        $u->last_name = $request->lastName;
        $u->username = $request->username;
        $u->email = $request->email;
        $u->nationality_id = $request->nationality;
        $u->nric = $request->nric;
        $u->mobile_number = $request->mobileNo;
        $u->user_role_id = $request->role;
        $u->is_active = $request->status;

        $u->save();

        if (empty($u->code)) {
            $u->code = 'U-' . sprintf('%05d', $u->id);
        }

        $u->photo_ext = $request->photoExt;
        if (!empty($request->photo)) {
            $image = base64_decode($request->photo);
            \Storage::disk('public')->put('user-profile/' . $u->id . '.' . $request->photoExt, $image);
        }
        $u->save();
    }
}
