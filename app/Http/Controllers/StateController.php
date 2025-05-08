<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    public function getCities(Request $request, $id)
    {
        if ($request->ajax()) {
            $cities = State::find($id)->cities()->select('id', 'description as text')->get();
            return response()->json(['cities'=> $cities]);
        }
    }
}
