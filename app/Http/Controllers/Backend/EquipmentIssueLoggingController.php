<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\Helper;
use App\Models\EquipmentIssueLogging;
use App\Models\JobOrder;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Equipment;
use App\Models\Taxonomy;
use App\Models\TaxonomyData;
use App\Models\WorkOrder;
use App\Models\WorkOrderImages;
use App\Models\WorkOrderMeta;
use App\Models\ContactForm;
use App\Models\adminMail;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB, Auth;

class EquipmentIssueLoggingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) 
        {
            $role = Role::findOrFail(Auth::user()->roles->first()->id);
            $groupsWithRoles = $role->getPermissionNames()->toArray();
        
            if(Auth::user()->hasRole('admin|Super-Admin'))
            {
                $equipment_issues = EquipmentIssueLogging::orderBy('id','DESC')->get();
            }
            if(Auth::user()->hasRole('Staff'))
            {
                $equipment_issues = EquipmentIssueLogging::where('staff_id', Auth::user()->id)->orderBy('id','DESC')->get();
            }
            if(Auth::user()->hasRole('Client'))
            {
                $equipment_issues = EquipmentIssueLogging::where('client_id', Auth::user()->id)->orderBy('id','DESC')->get();
            }

            return view('backend.equipment_issue_logging.list', compact('equipment_issues', 'groupsWithRoles'));
        }
        else
        {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffs = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'staff');
        })->where('status', '1')->orderBy('id','ASC')->get();

        $clients = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'client');
        })->where('status', '1')->orderBy('id','ASC')->get();
        
        $customers = Equipment::where('status', '1')->orderBy('id','ASC')->get();
        
        $inventories = Inventory::where('status', '1')->orderBy('id','ASC')->get();
        
        $departments = Department::where('status', '1')->orderBy('id','ASC')->get();
        
        return view('backend.equipment_issue_logging.add', compact('staffs', 'clients', 'customers', 'inventories', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'equipment_id'   => 'required',
            'address' => 'required',
            'staff_id' => 'required',
            'client_id' => 'required',
            'orderdate' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails())
        {
            return redirect()->route('equipment_issues.create')->withErrors(__($validator->errors()));
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
            
            $equipmentIssueLogging->user_id = Auth::user()->id;
            $equipmentIssueLogging->equipment_id = $request->equipment_id;
            $equipmentIssueLogging->priority = $request->priority;
            $equipmentIssueLogging->scope_of_work = $request->scope_of_work;
            $equipmentIssueLogging->description = $request->description;
            $equipmentIssueLogging->department_no = $request->department_no;
            $equipmentIssueLogging->staff_id = $request->staff_id;
            $equipmentIssueLogging->client_id = $request->client_id;
            $equipmentIssueLogging->address = $request->address;
            $equipmentIssueLogging->orderdate = date('Y-m-d h:i:s', strtotime($request->orderdate));
            $equipmentIssueLogging->start_date = date('Y-m-d h:i:s', strtotime($request->orderdate));
            $equipmentIssueLogging->status = $request->status;
            $equipmentIssueLogging->created_by = Auth::user()->id;
         
            if($equipmentIssueLogging->save())
            {
                $url = parse_url(route('equipment_issues.show', $equipmentIssueLogging->id))['path'];
                
                $sendMail = Helper::sendMailJobOrder(User::find($request->staff_id), 'New Equipment Issue', $request->all(), $url, $equipmentIssueLogging->id);
                
                return redirect()->route('equipment_issues.index')->withSuccess(__('Equipment Issue added successfully.'));
            }
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EquipmentIssueLogging  $equipmentIssueLogging
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipmentIssueLogging = EquipmentIssueLogging::find($id);
        $images = WorkOrderImages::where('workorder_id', $equipmentIssueLogging->id)->get();
        $work_orders_meta =  JobOrder::where('eilid', $id)->get();
        
        return view('backend.equipment_issue_logging.view', [ 'work_order' => $equipmentIssueLogging, 'images' => $images, 'work_orders_meta' => $work_orders_meta ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EquipmentIssueLogging  $equipmentIssueLogging
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staffs = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'staff');
        })->where('status', '1')->orderBy('id','ASC')->get();

        $clients = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'client');
        })->where('status', '1')->orderBy('id','ASC')->get();
        
        $customers = Equipment::where('status', '1')->orderBy('id','ASC')->get();
        
        $equipmentIssueLogging = EquipmentIssueLogging::find($id);
        
        $inventories = Inventory::where('status', '1')->orderBy('id','ASC')->get();
        
        $departments = Department::where('status', '1')->orderBy('id','ASC')->get();

        return view('backend.equipment_issue_logging.edit', [ 'equipment_issue' => $equipmentIssueLogging, 'staffs' => $staffs, 'clients' => $clients, 'customers' => $customers, 'inventories' => $inventories, 'departments' => $departments ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EquipmentIssueLogging  $equipmentIssueLogging
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $request->validate([
            'equipment_id' => 'required',
            'status' => 'required',
        ]);

        $equipmentIssueLogging = EquipmentIssueLogging::find($id);
        $equipmentIssueLogging->user_id = Auth::user()->id;
        $equipmentIssueLogging->equipment_id = $request->equipment_id;
        $equipmentIssueLogging->priority = $request->priority;
        $equipmentIssueLogging->scope_of_work = $request->scope_of_work;
        $equipmentIssueLogging->description = $request->description;
        $equipmentIssueLogging->staff_id = $request->staff_id;
        $equipmentIssueLogging->client_id = $request->client_id;
        $equipmentIssueLogging->address = $request->address;
        $equipmentIssueLogging->department_no = $request->department_no;
        $equipmentIssueLogging->orderdate = date('Y-m-d h:i:s', strtotime($request->orderdate));
        $equipmentIssueLogging->start_date = date('Y-m-d h:i:s', strtotime($request->orderdate));
        $equipmentIssueLogging->status = $request->status;
        $equipmentIssueLogging->updated_by = Auth::user()->id;
   
        if($equipmentIssueLogging->save())
        {
            $sendMail = Helper::sendMailJobOrder(User::find($request->staff_id), 'Revise Equipment Issue', $request->all());  
            
            return redirect()->route('equipment_issues.index')->with('success', 'Equipment issue has been updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EquipmentIssueLogging  $equipmentIssueLogging
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipmentIssueLogging = EquipmentIssueLogging::find($id);
        
        if($equipmentIssueLogging->delete())
        {
            return back()->with('success', $equipmentIssueLogging->equipment->title.' Equipment Issue has been deleted successfully!');
        }
    }
    
    public function orderIndex($id)
    {
        if (Auth::check()) 
        {
            $role = Role::findOrFail(Auth::user()->roles->first()->id);
            $groupsWithRoles = $role->getPermissionNames()->toArray();
        
            if(Auth::user()->hasRole('admin|Super-Admin|Client'))
            {
                $work_orders = JobOrder::where('eilid', $id)->orderBy('id','DESC')->get();
            }
            if(Auth::user()->hasRole('Staff'))
            {
                $work_orders = JobOrder::where('eilid', $id)->where('job_performed_by', Auth::user()->id)->orderBy('id','DESC')->get();
            }

            return view('backend.equipment_issue_logging.workorder.list', compact('work_orders', 'groupsWithRoles', 'id'));
        }
        else
        {
            return redirect()->route('dashboard');
        }
    }
    
    public function orderCreate($id)
    {
        $staffs = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'staff');
        })->where('status', '1')->orderBy('id','DESC')->get();

        $clients = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'client');
        })->where('status', '1')->orderBy('id','DESC')->get();
        
        $customers = Equipment::where('status', '1')->orderBy('id','DESC')->get();
        
        return view('backend.equipment_issue_logging.workorder.add', compact('id', 'staffs', 'clients', 'customers'));
    }
    
    public function orderStore(Request $request, $id)
    {
        $equipmentIssueLogging = EquipmentIssueLogging::find($request->equipmentissueID);
        
        if(!empty($equipmentIssueLogging))
        {
            $JobOrder = New JobOrder();
            $JobOrder->eilid = $request->equipmentissueID;
            $JobOrder->job_performed_by = $request->job_performed_by;
            $JobOrder->start_date = date('Y-m-d h:i:s', strtotime($request->start_date));
            $JobOrder->end_date = date('Y-m-d h:i:s', strtotime($request->end_date));
            $JobOrder->remarks = $request->remarks;
            $JobOrder->created_by = Auth::user()->id;
            
            if($JobOrder->save())
            {
               return redirect()->route('equipment_issues_order.index', $request->equipmentissueID)->with('success', 'Work Order has been added successfully!'); 
            }
             
        }
    }
    
    public function orderEdit($id, $eilid)
    {
        $staffs = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'staff');
        })->where('status', '1')->orderBy('id','DESC')->get();
        
        $work_order = JobOrder::find($eilid);
        
        return view('backend.equipment_issue_logging.workorder.edit', compact('id', 'staffs', 'work_order'));
    }
    
    public function orderUpdate(Request $request, $id)
    {
        $equipmentIssueLogging = EquipmentIssueLogging::find($request->equipmentissueID);
        
        if(!empty($equipmentIssueLogging))
        {
           // echo '<pre>'; print_r($id); echo '</pre>';
            
            $JobOrder = JobOrder::find($id);
            
            $JobOrder->eilid = $request->equipmentissueID;
            $JobOrder->job_performed_by = $request->job_performed_by;
            $JobOrder->start_date = date('Y-m-d h:i:s', strtotime($request->start_date));
            $JobOrder->end_date = date('Y-m-d h:i:s', strtotime($request->end_date));
            $JobOrder->remarks = $request->remarks;
            $JobOrder->updated_by = Auth::user()->id;
            
            if($JobOrder->save())
            {
              return redirect()->route('equipment_issues_order.index', $request->equipmentissueID)->with('success', 'Work Order has been updated successfully!'); 
            }
             
        }
        else
        {
            return back()->with('error', 'Work Order has been not updated!');
        }
    }
    
    public function orderDestroy($id, $eilid)
    {
        $JobOrder = JobOrder::find($eilid);
        
        if($JobOrder->delete())
        {
            return back()->with('success', 'Job Order has been deleted successfully!');
        }
        
    }
}
