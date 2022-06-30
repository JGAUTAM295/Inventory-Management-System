<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

class AuthController extends BaseController
{
    public function getUserRole()
    {
        $roles = Role::pluck('name','name')->all();

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
                    $success['image'] =  asset('/public/image/'.$auth->image);
           
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
            return $this->handleError($validator->errors());       
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
            $filename = $imagename.'_'.time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('public/Image'), $filename);
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
        $credentials = request()->validate(['email' => 'required|email']);

        $token = Str::random(64);

        DB::table('password_resets')->insert([

            'email' => $request->email, 

            'token' => $token, 

            'created_at' => Carbon::now()

          ]);



        Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){

            $message->to($request->email);

            $message->subject('Reset Password');

        });


        return $this->handleResponse('Reset password link sent on your email id!');

    }


    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();

        return $this->handleResponse('User logged out!');

    }
}
