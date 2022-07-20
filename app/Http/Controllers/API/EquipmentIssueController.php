<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Helper;
use App\Models\User;
use App\Models\WorkOrder;
use App\Models\Equipment;
use App\Models\EquipmentIssueLogging;
use App\Models\Inventory;
use App\Models\Department;
use Illuminate\Support\Str;
use Auth, Hash, DB, File;

class EquipmentIssueController extends BaseController
{
    
    //GET EQUIPMENT ISSUES
    public function equipment_issues()
    {
        if(Auth::user()->hasRole('Super-Admin'))
        {
            $work_orders = EquipmentIssueLogging::orderBy('id','DESC')->get();
        }
        
        if(Auth::user()->hasRole('admin'))
        {
            $work_orders = EquipmentIssueLogging::orderBy('id','DESC')->get();
        }
   
        if(Auth::user()->hasRole('Staff'))
        {
            $work_orders = EquipmentIssueLogging::where('staff_id', Auth::user()->id)->orderBy('id','DESC')->get();
        }
        if(Auth::user()->hasRole('Client'))
        {
            $work_orders = EquipmentIssueLogging::where('client_id', Auth::user()->id)->orderBy('id','DESC')->get();
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
                    'title' => "".ucwords(Equipment::find($work_order->equipment_id)->title)."",
                    'priority' => "".ucwords($work_order->priority)."",
                    'description' => "".$work_order->description."",
                    'order_date' => "".date('d M, Y h:i A', strtotime($work_order->orderdate))."",
                    'start_date' => "".date('d M, Y h:i A', strtotime($work_order->orderdate))."",
                    'end_date' => "".date('d M, Y h:i A', strtotime($work_order->end_date))."",
                    'status' => "".$status."",
                    'department_no' => $department,
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
    
    //GET EQUIPMENTS
    public function get_equipments()
    {
        if (Auth::check()) 
        {
           $equipments = Equipment::select('id', 'title')->where('status', '1')->orderBy('id','ASC')->get()->toArray();
           
            if(!empty($equipments))
            {
               return $this->handleResponse($equipments);
            }
            else
            {
                return $this->handleError('No Data Found!');
            }
        }
    }
    
    //GET STAFF
    public function get_staff()
    {
        if (Auth::check()) 
        {
            $staffs = array();
            
            $staffs = User::whereHas('roles', function ($q) {
                $q->where('name', '=', 'staff');
            })->select('id', 'name', 'email', 'image')->where('status', '1')->orderBy('id','ASC')->get()->toArray();
            
            foreach($staffs as $key => $staff)
            {
                $staffs[$key]['image'] = url('/').asset($staff['image']);
                
            }
            
            if(!empty($staffs))
            {
               return $this->handleResponse($staffs);
            }
            else
            {
                return $this->handleError('No Data Found!');
            }
            
           
        }
    }
    
    //GET CUSTOMERS
    public function get_customers()
    {
        if (Auth::check()) 
        {
            $inventories = Inventory::select('id', 'name', 'phone', 'address')->where('status', '1')->orderBy('id','ASC')->get()->toArray();
            
            if(!empty($inventories))
            {
               return $this->handleResponse($inventories);
            }
            else
            {
                return $this->handleError('No Data Found!');
            }
        }
    }
    
    //GET DEPARTMENTS
    public function get_departments()
    {
        if (Auth::check()) 
        {
            $departments = Department::select('id', 'name', 'department_no', 'colorbg')->where('status', '1')->orderBy('id','ASC')->get()->toArray();
        
            if(!empty($departments))
            {
               return $this->handleResponse($departments);
            }
            else
            {
                return $this->handleError('No Data Found!');
            }
        } 
    }
    
    //CREATE EQUIPMENT ISSUES
    public function create_equipment_issues(Request $request)
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
            $equipmentIssueLogging = New EquipmentIssueLogging();
            $latestOrder = EquipmentIssueLogging::orderBy('created_at','DESC')->first();
            
            if(!empty($latestOrder))
            {
                $equipmentIssueLogging->order_nr = '#'.str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT);
            }
            else
            {
                $equipmentIssueLogging->order_nr = '#'.str_pad(1, 8, "0", STR_PAD_LEFT);
            }
            
            $inventory = Inventory::where('id', $request->client_id)->where('status', '1')->orderBy('id','ASC')->first();
            
            $equipmentIssueLogging->user_id = Auth::user()->id;
            $equipmentIssueLogging->equipment_id = $request->equipment_id;
            $equipmentIssueLogging->priority = $request->priority;
            $equipmentIssueLogging->scope_of_work = $request->scope_of_work;
            $equipmentIssueLogging->description = $request->description;
            $equipmentIssueLogging->department_no = $request->department_no;
            $equipmentIssueLogging->staff_id = $request->staff_id;
            $equipmentIssueLogging->client_id = $request->client_id;
            $equipmentIssueLogging->address = $inventory->address;
            $equipmentIssueLogging->orderdate = date('Y-m-d h:i:s', strtotime($request->orderdate));
            $equipmentIssueLogging->start_date = date('Y-m-d h:i:s', strtotime($request->orderdate));
            $equipmentIssueLogging->status = $request->status;
            $equipmentIssueLogging->created_by = Auth::user()->id;
         
            if($equipmentIssueLogging->save())
            {
                $sendMail = Helper::sendMailJobOrder(User::find($request->staff_id), 'New Equipment Issue', $request->all());
                
                return $this->handleResponse(null, 'Equipment Issue added successfully!');
                
            }
        }   
        
    }
}
