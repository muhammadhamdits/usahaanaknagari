<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username'; //or return the field which you want to use.
    }
    protected function attemptLogin(Request $request)
    {
        // dd(Auth::guard('admin')->user());
        $pemilikAttempt = Auth::guard('web')->attempt(
            $this->credentials($request)
        );
        if(!$pemilikAttempt){
            // dd(Auth::guard('admin')->attempt(
            //     $this->credentials($request), $request->has('remember')
            // ));
            return Auth::guard('admin')->attempt(
                $this->credentials($request)
            );
        }
        return $pemilikAttempt;
    }
}
