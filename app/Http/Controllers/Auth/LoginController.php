<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
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

    protected $redirectTo = 'admin';

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }


    public function login(LoginRequest $request) {
        $remember = ($request->remember) ? true : false;
        if (Auth::attempt(['email' => strip_tags($request->email), 'password' => strip_tags($request->password)], $remember)) {
            return redirect('admin');
        }
    }
}
