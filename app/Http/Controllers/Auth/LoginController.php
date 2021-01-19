<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        $warningMessage = [ 'Kullanıcı adınızı ve şifrenizi kontrol edip tekrar deneyin..!'];

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
           return view('Main');
        }else{
            return view('auth.login',compact('warningMessage'));
        }
    }
    public function logOut()
    {

        //logout user
        Auth::logout();
        // redirect to homepage
        return view('auth/login');
    }
}
