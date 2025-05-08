<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserRole;
use App\Models\Branch;
use App\Models\Nationality;
use App\Models\Module;

class AccessControlController extends Controller
{
    public function index(Request $request)
    {
        $roles = UserRole::select('id', 'description')->orderBy('description')->get();
        $branches = Branch::select('id', 'description')->orderBy('description')->get();
        $nationalities = Nationality::orderBy('description')->get();
        $modules = Module::orderBy('name')->get();
        return view('general-setup/access-control', compact('roles', 'branches', 'nationalities', 'modules')); 
    }
}
