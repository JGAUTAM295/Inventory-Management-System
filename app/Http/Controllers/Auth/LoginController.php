<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Input;


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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    // Add device token to login
    public function login(Request $request)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails())
        {
            return redirect()->route('login')->withErrors($validator->errors())->with('error', 'Oppes! You have entered invalid credentials');
        }
        else
        {
          $credentials = $request->only('email', 'password');
          
          if (Auth::attempt($credentials)) 
          {
              Auth::user()->update(['device_token' => $request->token]);
              
              $token = Auth::user()->createToken('LaravelSanctumAuth')->plainTextToken;
              // Via a request instance...
             
              session(['accessToken' => $token]);
              
              return redirect()->route('dashboard');
              
          }
          else
          {
               return redirect()->route('login')->with('error', 'Oppes! You have entered invalid credentials');
          }  
        }       
      
    }
    
    public function logout()
    {
        Auth::user()->update(['device_token' => null]);
        Auth::logout();
        return redirect('/');
    }
}
