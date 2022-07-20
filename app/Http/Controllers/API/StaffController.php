<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use App\Models\User;
use App\Models\WorkOrder;
use App\Models\Equipment;
use App\Models\EquipmentIssueLogging;
use App\Models\Inventory;
use App\Models\Department;
use Illuminate\Support\Str;
use Validator;
use Auth, Hash, DB, File;

class StaffController extends BaseController
{
    public function workOrderList()
    {
        if(Auth::user()->hasRole('Super-Admin'))
        {
            $work_orders = WorkOrder::orderBy('id','DESC')->get();
        }
        
        if(Auth::user()->hasRole('admin'))
        {
            $work_orders = WorkOrder::orderBy('id','DESC')->get();
        }
   
        if(Auth::user()->hasRole('Staff'))
        {
            $work_orders = WorkOrder::where('staff_id', Auth::user()->id)->orderBy('id','DESC')->get();
        }
        if(Auth::user()->hasRole('Client'))
        {
            $work_orders = WorkOrder::where('client_id', Auth::user()->id)->orderBy('id','DESC')->get();
        }
        // else
        // {
        //     $work_orders = array();
        // }
        
       
        if(!empty($work_orders))
        {
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

                $staff = $client = $department = array();

                $staff_data = User::where('id', $work_order->staff_id)->where('status', '1')->first();

                if(!empty($staff_data)) {
                    $staff = array(
                        'id' => "".$staff_data->id."",
                        'name' => "".$staff_data->name."",
                        'image' => "".url('/').asset($staff_data->image)."",
                    );
                }

                //$client_data = User::where('id', $work_order->client_id)->where('status', '1')->first();

                if(!empty($work_order->client)) {
                    $client = array(
                        'id' => "".$work_order->client->id."",
                        'name' => "".$work_order->client->name."",
                        'address' => "".$work_order->client->address."",
                        'phone' => "".$work_order->client->phone."",
                    );
                }
                
                if(!empty($work_order->department)) {
                    $department = array(
                        'id' => "".$work_order->department->id."",
                        'name' => "".$work_order->department->name."",
                        'department_no' => "".$work_order->department->department_no."",
                        'background_color' => "".$work_order->department->colorbg."",
                    );
                }
                
//print_r(Equipment::find(EquipmentIssueLogging::find($work_order->equipmentissue_id)->equipment_id)->title);
                $data[] = array(
                    'id' => "".$work_order->id."",
                    'order_number' => "".$work_order->department_no.'-'.$work_order->id."",
                    'title' => "".ucwords(Equipment::find(EquipmentIssueLogging::find($work_order->equipmentissue_id)->equipment_id)->title)."",
                    'priority' => "".ucwords($work_order->priority)."",
                    'description' => "".$work_order->description."",
                    'order_date' => "".date('d M, Y h:i A', strtotime($work_order->orderdate))."",
                    'start_date' => "".date('d M, Y h:i A', strtotime($work_order->start_date))."",
                    'end_date' => "".date('d M, Y h:i A', strtotime($work_order->end_date))."",
                    'status' => "".$status."",
                    'department' => $department,
                    'assigned_to_staff' => $staff, //staff_id
                    'client' => $client, //client_id
                );
            }
            
            if(!empty($data))
            {
                return $this->handleResponse($data);
            }
            else
            {
                return $this->handleError("Data not found!");
            }
            
        }
        else
        {
           return $this->handleError("Data not found!");
        }
       
    }
    
    //CREATE WORK Order
    public function create_work_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'equipment_id'   => 'required',
            'priority' => 'required',
            'scope_of_work' => 'required',
            'description' => 'required',
            'department_no' => 'required',
            'staff_id' => 'required',
            'client_id' => 'required',
            'orderdate' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return $this->handleError($validator->errors()->first());       
        }
        else
        {
            $inventory = Inventory::where('id', $request->client_id)->where('status', '1')->orderBy('id','ASC')->first();
            
            $newWorkOrder = New WorkOrder();
            $latestOrder = WorkOrder::orderBy('created_at','DESC')->first();
            
            if(!empty($latestOrder))
            {
                $newWorkOrder->order_nr = '#'.str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT);
            }
            else
            {
                $newWorkOrder->order_nr = '#'.str_pad(1, 8, "0", STR_PAD_LEFT);
            }
            
            $newWorkOrder->user_id = Auth::user()->id;
            $newWorkOrder->equipmentissue_id = $request->equipment_id;
            $newWorkOrder->priority = $request->priority;
            $newWorkOrder->description = $request->description;
            $newWorkOrder->scope_of_work = $request->scope_of_work;
            $newWorkOrder->staff_id = $request->staff_id;
            $newWorkOrder->client_id = $request->client_id;
            $newWorkOrder->address = $inventory->address;
            $newWorkOrder->department_no = $request->department_no;
            $newWorkOrder->orderdate = date('Y-m-d h:i:s', strtotime($request->orderdate));
            $newWorkOrder->start_date = date('Y-m-d h:i:s', strtotime($request->orderdate));
            $newWorkOrder->status = $request->status;
            $newWorkOrder->created_by = Auth::user()->id;
         
            if($newWorkOrder->save())
            {
                $sendMail = Helper::sendMailWorkOrder(User::find($request->staff_id), 'New Work Order', $request->all());
                
                return $this->handleResponse(null, 'Work Order created successfully!');
            }
  
        }     
    }
    
    //GET AUTH USER PROFILE
    public function profile() {
        $user = User::where('id', Auth::user()->id)->where('status', '1')->first();

        if(!empty($user)){
            $success['id']    =  $user->id;
            $success['name']  =  $user->name;
            $success['email'] =  $user->email;
            $success['image'] =  url('/').asset($user->image);
    
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
