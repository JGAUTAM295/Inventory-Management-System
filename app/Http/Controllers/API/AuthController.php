<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
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

class AuthController extends BaseController
{
    public function getUserRole()
    {
        $roles = Role::where([['name', '!=', 'Super-Admin'], ['name', '!=', 'admin']])->pluck('name','name')->all();

        $success['UserRole'] = $roles;
        
        return $this->handleResponse($success, '');
         
    }

    public function login(Request $request)
    {

        $data = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if ($data->fails())
        {
            return $this->handleError($data->errors()->first);
        }
        else
        {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                
                return $this->handleError('incorrect username or password');
        
            }
            else
            {
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                    $auth = Auth::user(); 
                    $success['token'] =  $auth->createToken('LaravelSanctumAuth')->plainTextToken; 
                    $success['id'] =  $auth->id;
                    $success['name'] =  $auth->name;
                    $success['email'] =  $auth->email;
                    $success['image'] =  url('/').asset($auth->image);
           
                    return $this->handleResponse($success, 'User logged-in!');
                } 
                else
                { 
                    return $this->handleError('Unauthorised.', ['error'=>'Unauthorised']);
                }
            }
        }
        
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->handleError($validator->errors()->first());       
        }
   
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $newUser = User::find($user->id);
        $newUser->status = '1';
        $newUser->updated_by =  $user->id;

        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $file= $request->file('image');
            $imagename = $file->getClientOriginalName();
            $imagename = explode('.', $imagename)[0];
            $filename = $imagename.'_'.time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('public/users'), $filename);
            $newUser->image = $filename;  
        }

        $newUser->save();
        $user->assignRole($request->input('roles'));

        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->handleResponse($success, 'User successfully registered!');
    }
    
    public function forgotPassword(Request $request)
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
        
        // Send email to user
        $subject = 'Reset Password';
        
        $headers = '';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: IMES <info@imes.com>' . "\r\n";
        $message  = '<!DOCTYPE html><html><head><title>IMES | Reset Password</title></head><body>';
        $message .= "<table width=100% border=0><tr><td>";
        $message .= "'<tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>IMES</font><h2></td></tr>";
        $message .= '<tr><td colspan=2><br/><br/><br/><strong>Dear '.$user->name.',</strong></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=3>We have received your request to reset your account password. You can use the following code to recover your account:</font><br/><br/>Code: '.$codeData->code.'</b></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=2>The allowed duration of the code is one hour from the time the message was sent.</font></td></tr>';
        $message .= '<tr><td colspan=2><br/><br/><font size=2>Best regards,<br>The IMES Team.</font></td></tr></table></body></html>';

        if(mail($request->email,$subject, $message, $headers))
        {
            return $this->handleResponse('Mail sent. Please check your inbox!', 200);
        }
        else
        {
            return $this->handleError('Mail not sent!', 400);
        }
        
    }
    
    public function codecheck(Request $request)
    {

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
        
        $user->tokens()->where('id', auth()->id())->delete();
        
        // delete current code 
        ResetCodePassword::firstWhere('code', $request->code)->delete();

        return $this->handleResponse('Password has been successfully reset!', 200);
    }


    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();

        return $this->handleResponse('User logged out!', 200);

    }
}
