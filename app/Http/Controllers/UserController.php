<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Auth, DB, Hash, File;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'Super-Admin');
        })->orderBy('id','DESC')->get();

        return view('backend.users.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('backend.users.add', compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $newUser = User::find($user->id);
        $newUser->status = $request->status;
        $newUser->updated_by =  Auth::user()->id;
        
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
    
        return redirect()->route('users')->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('backend.users.view',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('backend.users.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            //'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }
        else
        {
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        $user->status = $request->status;
        $user->updated_by =  Auth::user()->id;

        if($request->hasFile('image')){
            
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $image_path = public_path("/public/Image/".$user->image);
            
            if (File::exists($image_path)) 
            {
                File::delete($image_path);
            }

            $file= $request->file('image');
            $imagename = $file->getClientOriginalName();
            $filename = $imagename.'_'.time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('public/Image'), $filename);
            $user->image = $filename;  
        }

        $user->save();

        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users')->with('success','User updated successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users')->with('success','User deleted successfully');
    }

    public function getclients(Request $request)
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'Client');
        })->orderBy('id','DESC')->get();
        return view('backend.users.client',compact('users'));
    }

    public function getstaff(Request $request)
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'Staff');
        })->orderBy('id','DESC')->get();
        return view('backend.users.staff',compact('users'));
    }

    public function profile($id) 
    {
        $user = User::find($id);

        return view('backend.users.profile',compact('user'));
    }

    public function authRemove()
    {
        $user = User::find(Auth::user()->id);
        $staff_workOrder = WorkOrder::where('staff_id', Auth::user()->id)->delete();
        $client_workOrder = WorkOrder::where('client_id', Auth::user()->id)->delete();
        Auth::logout();
        if ($user->delete()) 
        {
            return redirect()->route('login')->with('global', 'Your account has been deleted!');
        }
    }
}
