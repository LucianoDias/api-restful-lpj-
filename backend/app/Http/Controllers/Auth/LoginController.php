<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/config';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(Request $request){
        $tries = $request->session()->get('login_tries', 0);
        $frase = __('menssages.test');
        echo $frase;

        return view('login' ,['tries'=>$tries]);
    }
    public function authenticate(Request $request){

        $creds = $request->only(['email','password']);
       

        if(Auth::attempt($creds)){
            $request->session()->put('login_tries',0);
            return redirect()->route('config.index');
        }else{
            $tries = intval($request->session()->get('login_tries', 0));
            $request->session()->put('login_tries', ++$tries);
            return redirect()->route('login')
                ->with('warning','E-mail e/ou senha inválidos.');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
