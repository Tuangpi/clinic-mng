<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\State;

use DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Supplier::active();

            return Datatables::of($data)
                ->filterColumn('city', function ($query, $keyword) {
                    $query->whereRaw("c.description like ?", ["%{$keyword}%"]);
                })
                ->make(true);
        }
        $states = State::orderBy('description')->get();

        return view('inventory-setup/suppliers', compact('states'));
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
            if ($request->name && Supplier::where('name', $request->name)->exists()) {
                return response()->json(['errMsg' => 'Name already exists', 'isError' => true]);
            }

            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $s = new Supplier;

            $s->created_by = $currentUserId;
            $s->updated_by = $currentUserId;
            $this->mapValues($s, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New supplier has been created.']);
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
            $s = Supplier::with([
                'city:id,description,state_id',
                'city.state:id,description'
            ])->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['supplier' => $s]);
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
            $s = Supplier::with('city:id,state_id')->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['supplier' => $s]);
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

            \DB::beginTransaction();

            $s = Supplier::find($id);

            if ($request->name && Supplier::where([
                ['name', $request->name],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Name already exists', 'isError' => true]);
            }

            $s->updated_by = \Auth::id();
            $this->mapValues($s, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Supplier has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $s = Supplier::find($id);

        if ($s->products()->exists()) {
            return response()->json(['errMsg' => 'Unable to delete, this supplier is used in an item inventory.', 'isError' => true]);
        }
        $s->delete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    private function mapValues($s, $request)
    {
        $s->name = $request->name;
        $s->contact_person = $request->contactPerson;
        $s->description = $request->description;
        $s->address = $request->address;
        $s->city_id = $request->city;
        $s->zip_code = $request->zipCode;
        $s->mobile_number = $request->mobileNo;
        $s->tel_number = $request->telNo;
        $s->email = $request->email;
        $s->notes = $request->notes;
        $s->is_supplier = $request->isSupplier;
        $s->is_manufacturer = $request->isManufacturer;
        $s->save();

        if (empty($s->code)) {
            $s->code = 'SUP-' . sprintf('%05d', $s->id);
        }

        $s->save();
    }
}
