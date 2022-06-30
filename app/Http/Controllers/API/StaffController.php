<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Support\Str;
use Validator;
use Auth, Hash, DB, File;

class StaffController extends BaseController
{
    public function workOrderList()
    {
       
            if(Auth::user()->hasRole('Staff'))
            {
                $work_orders = WorkOrder::where('staff_id', Auth::user()->id)->orderBy('id','DESC')->get();
            }
            if(Auth::user()->hasRole('Client'))
            {
                $work_orders = WorkOrder::where('client_id', Auth::user()->id)->orderBy('id','DESC')->get();
            }

            $data = array();
            foreach($work_orders as $work_order)
            {
                if($work_order->status == '1') {
                    $status = 'Cancelled';
                }
                elseif($work_order->status == '2') {
                    $status = 'Started';
                }
                elseif($work_order->status == '3') {
                    $status = 'Pending';
                }
                elseif($work_order->status == '4') {
                    $status = 'Processing';
                }
                elseif($work_order->status == '5') {
                    $status = 'Complete';
                }
                else 
                {
                    $status = 'Pending';
                }

                $staff = $client = array();

                $staff_data = User::where('id', $work_order->staff_id)->where('status', '1')->first();

                if(!empty($staff_data)) {
                    $staff = array(
                        'id' => "".$staff_data->id."",
                        'name' => "".$staff_data->name."",
                        'image' => "".asset('/public/image/'.$staff_data->image)."",
                    );
                }

                $client_data = User::where('id', $work_order->client_id)->where('status', '1')->first();

                if(!empty($staff_data)) {
                    $client = array(
                        'id' => "".$client_data->id."",
                        'name' => "".$client_data->name."",
                        'image' => "".asset('/public/image/'.$client_data->image)."",
                    );
                }

                $data[] = array(
                    'id' => "".$work_order->id."",
                    'title' => "".$work_order->title."",
                    'description' => "".$work_order->description."",
                    'order_date' => "".date('d M, Y h:i A', strtotime($work_order->orderdate))."",
                    'start_date' => "".date('d M, Y h:i A', strtotime($work_order->start_date))."",
                    'end_date' => "".date('d M, Y h:i A', strtotime($work_order->end_date))."",
                    'status' => "".$status."",
                    'assigned_to_staff' => $staff, //staff_id
                    'client' => $client, //client_id
                );
            }

            return $this->handleResponse($data); 
       
    }

    public function profile() {
        $user = User::where('id', Auth::user()->id)->where('status', '1')->first();

        if(!empty($user)){
            $success['id']    =  $user->id;
            $success['name']  =  $user->name;
            $success['email'] =  $user->email;
            $success['image'] =  asset('/public/image/'.$user->image);
    
            return $this->handleResponse($success);
        }
    }

    public function changePassword(Request $request) 
    {
        $data = $request->all();
        $user = Auth::user();

        //Changing the password only if is different of null
        
        if( isset($data['oldPassword']) && !empty($data['oldPassword']) && $data['oldPassword'] !== "" && $data['oldPassword'] !=='undefined') {
         //checking the old password first
            $check  = Auth::guard('web')->attempt([
                'email' => $user->email,
                'password' => $data['oldPassword']
            ]);

        if($check && isset($data['newPassword']) && !empty($data['newPassword']) && $data['newPassword'] !== "" && $data['newPassword'] !=='undefined') {
             $user->password = Hash::make($data['newPassword']);
             Auth::user()->tokens()->delete();
  
             //Changing the type
             $user->save();
             $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
             
             return $this->handleResponse($success, 'Password Changed Successfully!');
        }
        else 
        {
            return $this->handleError("Wrong password information");
        }
    }
     return $this->handleError("Wrong password information");
    }
}
