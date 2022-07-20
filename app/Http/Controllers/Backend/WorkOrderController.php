<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Helpers\Helper;
use App\Models\EquipmentIssueLogging;
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
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB, Auth;

class WorkOrderController extends Controller
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
            
            return view('backend.work_order.list', compact('work_orders', 'groupsWithRoles'));
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

        $equipment_issues = EquipmentIssueLogging::orderBy('id','ASC')->get();
        
        $inventories = Inventory::where('status', '1')->orderBy('id','ASC')->get();
        
        $departments = Department::where('status', '1')->orderBy('id','ASC')->get();
        
        return view('backend.work_order.add', compact('staffs', 'clients', 'customers', 'equipment_issues', 'inventories', 'departments'));
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
            'equipment_id' => 'required',
            'address' => 'required',
            'staff_id' => 'required',
            'client_id' => 'required',
            'orderdate' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails())
        {
             return view('backend.work_order.list')->with('status', $validator->errors()->first());
        }
        else
        {
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
            $newWorkOrder->address = $request->address;
            $newWorkOrder->scope_of_work = $request->scope_of_work;
            $newWorkOrder->staff_id = $request->staff_id;
            $newWorkOrder->client_id = $request->client_id;
            $newWorkOrder->department_no = $request->department_no;
            $newWorkOrder->orderdate = date('Y-m-d H:i:s', strtotime($request->orderdate));
            $newWorkOrder->start_date = date('Y-m-d h:i:s', strtotime($request->orderdate));
            $newWorkOrder->status = $request->status;
            $newWorkOrder->created_by = Auth::user()->id;
         
            if($newWorkOrder->save())
            {
                $url = parse_url(route('work_order.show', $newWorkOrder->id))['path'];
                
                $sendMail = Helper::sendMailWorkOrder(User::find($request->staff_id), 'New Work Order', $request->all(), $url, $newWorkOrder->id);
                
                return redirect()->route('work_order.index')->withSuccess(__('Work Order created successfully.'));
            }
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkOrder $workOrder
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOrder $workOrder)
    {
        $images = WorkOrderImages::where('workorder_id', $workOrder->id)->get();
        $work_orders_meta = WorkOrderMeta::where('woid', $workOrder->id)->get();
        $equipment_id = EquipmentIssueLogging::find($workOrder->equipmentissue_id)->equipment_id;
        $title = Equipment::find($equipment_id)->title;
        
        if(!empty($_GET['id']))
        {
            $notification = Notification::where('id', $_GET['id'])->update(['read_at' => '1']);
        }
        
        return view('backend.work_order.view', [ 'work_order' => $workOrder, 'images' => $images, 'work_orders_meta' => $work_orders_meta, 'workordertitle' => $title ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOrder $workOrder)
    {
        $staffs = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'staff');
        })->where('status', '1')->orderBy('id','ASC')->get();

        $clients = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'client');
        })->where('status', '1')->orderBy('id','ASC')->get();
        
        $customers = Equipment::where('status', '1')->orderBy('id','ASC')->get();
        
        $equipment_issues = EquipmentIssueLogging::orderBy('id','ASC')->get();
        
        $inventories = Inventory::where('status', '1')->orderBy('id','ASC')->get();
        
        $departments = Department::where('status', '1')->orderBy('id','ASC')->get();

        return view('backend.work_order.edit', [ 'work_order' => $workOrder,  'staffs' => $staffs, 'clients' => $clients, 'customers' => $customers, 'equipment_issues' => $equipment_issues, 'inventories' => $inventories, 'departments' => $departments ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'equipment_id' => 'required',
            'status' => 'required',
        ]);

        $workOrder = WorkOrder::find($id);
        $latestOrder = WorkOrder::orderBy('created_at','DESC')->first();
        $workOrder->equipmentissue_id = $request->equipment_id;
        $workOrder->priority = $request->priority;
        $workOrder->description = $request->description;
        $workOrder->address = $request->address;
        $workOrder->scope_of_work = $request->scope_of_work;
        $workOrder->staff_id = $request->staff_id;
        $workOrder->client_id = $request->client_id;
        $workOrder->department_no = $request->department_no;
        $workOrder->orderdate = date('Y-m-d H:i:s', strtotime($request->orderdate));
        $workOrder->start_date = date('Y-m-d h:i:s', strtotime($request->orderdate));
        $workOrder->status = $request->status;
        $workOrder->updated_by = Auth::user()->id;
   
        if($workOrder->save())
        {
            return redirect()->route('work_order.index')->with('success', 'Work Order has been updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workOrder = WorkOrder::find($id);
        if($workOrder -> delete()){
            return back()->with('success', 'Work Order has been deleted successfully!');
        }
    }

    // Upload Work images functions
    public function update_workorder(Request $request)
    {
        $workOrder = WorkOrder::find($request->id);
        
        if(!empty($workOrder))
        {
            if(!empty($request->date_job_completed))
            {
              $workOrder->end_date = date('Y-m-d h:i:s', strtotime($request->date_job_completed));  
            }
            
            $workOrder->status = $request->status;
            $workOrder->updated_by = Auth::user()->id;
            $workOrder->save();
            
            // if(!empty($request->end_date))
            // {
            //     $end_date = date('Y-m-d h:i:s', strtotime($request->end_date));
            // }
            // else
            // {
            //     $end_date = null;
            // }
            
            $workOrderMeta = New WorkOrderMeta();
            $workOrderMeta->woid = $request->id;
            $workOrderMeta->job_performed_by = $request->job_performed_by;
            $workOrderMeta->start_date = date('Y-m-d h:i:s', strtotime($request->start_date));
            $workOrderMeta->end_date = date('Y-m-d h:i:s', strtotime($request->end_date));
            $workOrderMeta->remarks = $request->remarks;
            $workOrderMeta->created_by = Auth::user()->id;
            $workOrderMeta->save();

            if($request->hasFile('images')) 
            {
                $allowedfileExtension=['pdf','jpg','png'];
                $files = $request->file('images');
                $errors = [];
                
                foreach($files as $file)
                {
                    $extension = $file->getClientOriginalExtension();
                    $check = in_array($extension,$allowedfileExtension);

                    if($check)
                    {
                        $imagename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $filename = $imagename.'_'.uniqid() . '.' . $file->getClientOriginalExtension();
                        $foldername  = "images/work_order/".date("Y");
                        $foldername2 = "images/work_order/".date("Y")."/".date("m");
                        $foldername3 = "images/work_order/".date("Y")."/".date("m")."/".date("d");
                        
                        // if(file_exists($foldername))
                        // {
                        //     if(file_exists($foldername2)==false)
                        //     {
                        //         if(file_exists($foldername3)==false)
                        //         {
                        //             mkdir($foldername3, 777, true);
                        //         }
                        //     }
                        // }
                        // else
                        // {
                        //     mkdir($foldername, 777, true);
                        //     mkdir($foldername2, 777, true);
                        //     mkdir($foldername3, 777, true);
                        // }
                        
                        //store file inlocaly
                        $file->move(public_path($foldername3), $filename);
                        $workOrderImages = New WorkOrderImages();
                        $workOrderImages->image = $foldername3.'/'.$filename;
                        $workOrderImages->workorder_id = $request->id;
                        $workOrderImages->user_id = Auth::user()->id;
                        $workOrderImages->title = $request->title;
                        $workOrderImages->type = $request->type; // {0=> Before, 1=> After}
                        $workOrderImages->created_by = Auth::user()->id;
                        $workOrderImages->save();
                        
                        //echo '<pre>'; print_r($workOrderImages); echo '</pre>';
                    }
                    else
                    {
                        return response()->json(['status' => 'false', 'message' => 'invalid_file_format'], 422);
                    }
                }
            }
            
            if(!empty(Helper::websetting('sitename')))
            {
              $sitename = Helper::websetting('sitename');
            }
            else
            {
                $sitename = "IMES";
            }
            
             $equipment_id = EquipmentIssueLogging::find($workOrder->equipmentissue_id)->equipment_id;
             $wtitle = Equipment::find($equipment_id)->title;
            
            $to = env('ADMIN_EMAIL');
            $email_to = "jyoti.610weblab@gmail.com,".User::find($workOrder->user_id)->email.",".$workOrder->staff->email;
            $subject = 'Job Order Form ('.$wtitle.') '.date('d M, Y h:i:s A');
            
            $headers = '';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: IMES <info@imes.com>' . "\r\n";
            $message  = '<!DOCTYPE html><html><head><title>'.$sitename.' | Job Order Form</title></head><body>';
            $message .= '<table width=100% border=0><tr><td>';
            $message .= '<tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>'.$sitename.'</font><h2></td></tr>';
            $message .= '<tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr>';
            $message .= '<tr><td colspan=2><br/><font size=3><b>Title: </b>'.$wtitle.'</font></td></tr>';
            $message .= '<tr><td colspan=2><br/><font size=3><b>Start Date: </b>'.date('Y-m-d h:i:s', strtotime($request->start_date)).'</font></td></tr>';
            if($request->end_date == '0000-00-00 00:00:00' || $request->end_date == '')
            {
                $message .= '<tr><td colspan=2><br/><font size=3><b>End Date: </b> - </font></td></tr>';
            }
            else
            {
                $message .= '<tr><td colspan=2><br/><font size=3><b>End Date: </b>'.date('Y-m-d h:i:s', strtotime($request->end_date)).'</font></td></tr>';
            }
            $message .= '<tr><td colspan=2><br/><font size=3><b>Remarks: </b>'.$request->remarks.'</font></td></tr>';
            $message .= '<tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>'.Auth::user()->name.'</font></td></tr></table></body></html>';
            
            $implodearry = $workOrder->user_id.','.$workOrder->staff_id;
            
            if(mail($email_to, $subject, $message, $headers))
            {
                foreach(explode(',', $implodearry) as $implode)
                {
                    
                    $implodeID = User::find($implode);
                    if($implodeID->roles->pluck('name')[0] == 'Super-Admin') 
                    {
                        $newcf = New adminMail();
                    }
                    else
                    {
                        $newcf = New ContactForm();
                    }
                    
                    $newcf->user_id = $implodeID->id;
                    $newcf->title = $wtitle;
                    $newcf->message = $request->remarks;
                    $newcf->email_msg = $message;
                    $newcf->type = 'job_order_reported';
                    $newcf->created_by = Auth::user()->id;
                    
                    if($newcf->save())
                    {
                        if(!empty($implodeID->device_token))
                        {
                            Helper::fcmNotification($implodeID->device_token);
                        }
                    }
                }
            }
            
            return response()->json(['status' => 'true', 'message' => 'Data Updated Successfully!'], 200);
            
        }
        else
        {
            return response()->json(['status' => 'false', 'message' => 'Work Order Not Found!'], 404);
        }
    }
}
