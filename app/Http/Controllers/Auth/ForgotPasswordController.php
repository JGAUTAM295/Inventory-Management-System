<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Hash, DB, File, Mail;
use Carbon\Carbon;
use App\Mail\SendCodeResetPassword;
use App\Http\Requests\Auth\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    
    public function postEmail(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        // Delete all old code that user send before.
        ResetCodePassword::where('email', $request->email)->delete();

        // Generate random code
        $data['code'] = mt_rand(100000, 999999);

        // Create a new code
        $codeData = ResetCodePassword::create($data);
        
        $user = User::where('email', $request->email)->first();
        
        //$msg = new \App\Mail\SendCodeResetPassword($codeData->code);
        $base_url = url('/');
        $encrypt = \Crypt::encrypt($codeData->code);
        
        // Send email to user
        $subject = 'Reset Password';
        $headers = '';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: IMES <info@imes.com>' . "\r\n";
        $message  = '<!DOCTYPE html><html><head><title>IMES | Reset Password</title></head><body>';
        $message .= "<table width=100% border=0><tr><td>";
        $message .= "'<tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IMES</font><h2></td></tr>";
        $message .= '<tr><td colspan=2><br/><br/><br/><strong><font size=3>Dear '.$user->name.',</font></strong></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=3>We have received your request to reset your account password. You can use the following code to recover your account:</font><br/><br/> <a href="'.$base_url.'/password/reset/'.$encrypt.'">Click Here</a></b></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=2>The allowed duration of the code is one hour from the time the message was sent.</font></td></tr>';
        $message .= '<tr><td colspan=2><br/><br/><font size=2>Best regards,<br>The IMES Team.</font></td></tr></table></body></html>';

        if(mail($request->email,$subject, $message, $headers))
        {
            return back()->with('status', 'We have e-mailed your password reset link!');
        }
        else
        {
            return back()->with('status', 'E-mailed not sent!');
        }
      
    }
    
    
}
