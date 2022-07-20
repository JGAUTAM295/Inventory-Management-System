<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Hash, DB, File, Mail;
use Carbon\Carbon;
use App\Mail\SendCodeResetPassword;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Support\Facades\Crypt;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    
    public function customshowResetForm($token) 
    {

       $passwordReset = ResetCodePassword::firstWhere('code', Crypt::decrypt($token));
       
       $token = Crypt::decrypt($token);
       
       return view('auth.passwords.reset', compact('passwordReset', 'token'));
       
    }
    
    public function customreset(Request $request)
    {
//Admin123@#
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
            'password' => 'required|string|min:6',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);
        

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) 
        {
            ResetCodePassword::firstWhere('code', $request->code)->delete();
            
            return $this->handleResponse('Password has been expired. Please try again later!', 200);
        }

        // find user's email 
        $user = User::firstWhere('email', $passwordReset->email);

        // update user password
        $user->password = Hash::make($request->input('password'));
        $user->save();
        
        Auth::setUser($user);
        Auth::logout();
        
        // delete current code 
        ResetCodePassword::firstWhere('code', $request->code)->delete();
        
        $base_url = url('/');
        
        // Send email to user
        $subject = 'Password Changed';
        $headers = '';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: IMES <info@imes.com>' . "\r\n";
        $message  = '<!DOCTYPE html><html><head><title>IMES | Reset Password</title></head><body>';
        $message .= "<table width=100% border=0><tr><td>";
        $message .= "'<tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IMES</font><h2></td></tr>";
        $message .= '<tr><td colspan=2><br/><br/><br/><strong><font size=3>Dear '.$user->name.',</font></strong></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=3>You have successfully change your account password. Please click on click here for login</font><br/><br/> <a href="'.$base_url.'">Click Here</a></b></td></tr>';
        $message .= '<tr><td colspan=2><br/><br/><font size=2>Best regards,<br>The IMES Team.</font></td></tr></table></body></html>';

        if(mail($user->email,$subject, $message, $headers))
        {
            return redirect()->route('login')->with('status', 'Password has been successfully reset!');
        }
        else
        {
            return redirect()->route('login')->with('status', 'Email not sent!');
        }
        
        

    }
}
