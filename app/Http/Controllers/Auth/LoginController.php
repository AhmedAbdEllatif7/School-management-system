<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\AuthTrait;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    use AuthTrait;

    public function loginForm($type){

        return view('auth.login',compact('type'));
    }

    public function login(Request $request){

        if (Auth::guard($this->checkGuard($request->type))->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->redirect($request);
        }


        else{
            return redirect()->back()->with('message', trans('main_trans.error_login'));
        }
    }

    public function logout(Request $request, $type)
    {
        $user = Auth::guard($type)->user();

        if (!$user) {

            return redirect('/')->with('error', 'Invalid user type for logout.');
        }

        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
