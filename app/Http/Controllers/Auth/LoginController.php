<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Branch;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    
    public function username()
    {
        return 'username'; //or return the field which you want to use.
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $branches = Branch::orderBy('description')->get();
        return view('auth.login', compact('branches'));
    }
    
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
            'branch' => 'required'
        ]);
    }

    protected function credentials(Request $request)
    {
        return ['username' => $request->{$this->username()}, 'password' => $request->password, 'is_active' => true];
    }
    
    protected function authenticated(Request $request, $user)
    {
        $branch = !$user->is_administrator ? 
                    $user->branches()->where('branch_id', $request->branch)->first()
                    : Branch::find($request->branch);
        if (!$branch) {
            $this->guard()->logout();
        
            return redirect('login')->withErrors(['username'=>'You\'re not allowed to access the selected branch']);
        }
        session(['branch' => $branch]);
    }
}
