<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Equipment;
use App\Models\Taxonomy;
use App\Models\TaxonomyData;
use App\Models\WorkOrder;
use App\Models\WorkOrderImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

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

            return view('backend.work_order.list', compact('work_orders'));
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
        })->where('status', '1')->orderBy('id','DESC')->get();

        $clients = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'client');
        })->where('status', '1')->orderBy('id','DESC')->get();
        
        return view('backend.work_order.add', compact('staffs','clients'));
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
            'name'   => 'required',
            'staff_id' => 'required',
            'client_id' => 'required',
            'orderdate' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails())
        {
             return view('backend.inventories.list')->with('status', $validator->errors()->first());
        }
        else
        {
            $newWorkOrder = New WorkOrder();
            $newWorkOrder->user_id = Auth::user()->id;
            $newWorkOrder->title = $request->name;
            $newWorkOrder->description = $request->description;
            $newWorkOrder->staff_id = $request->staff_id;
            $newWorkOrder->client_id = $request->client_id;
            $newWorkOrder->orderdate = date('Y-m-d H:i:s', strtotime($request->orderdate));
            $newWorkOrder->start_date = date('Y-m-d h:i:s', strtotime($request->orderdate));
            $newWorkOrder->status = $request->status;
            $newWorkOrder->created_by = Auth::user()->id;
         
            if($newWorkOrder -> save())
            {
                return redirect()->route('work_order.index')->withSuccess(__('Work Order created successfully.'));
            }
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOrder $workOrder)
    {
        $images = WorkOrderImages::where('workorder_id', $workOrder->id)->get();
        return view('backend.work_order.view', [ 'work_order' => $workOrder, 'images' => $images ]);
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
        })->where('status', '1')->orderBy('id','DESC')->get();

        $clients = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'client');
        })->where('status', '1')->orderBy('id','DESC')->get();

        return view('backend.work_order.edit', [ 'work_order' => $workOrder,  'staffs' => $staffs, 'clients' => $clients ]);
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
            'name' => 'required',
            'status' => 'required',
        ]);

        $workOrder = WorkOrder::find($id);
        $workOrder->user_id = Auth::user()->id;
        $workOrder->title = $request->name;
        $workOrder->description = $request->description;
        $workOrder->staff_id = $request->staff_id;
        $workOrder->client_id = $request->client_id;
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
            $workOrder->start_date = date('Y-m-d h:i:s', strtotime($request->start_date));
            $workOrder->end_date = date('Y-m-d h:i:s', strtotime($request->end_date));
            $workOrder->status = $request->status;
            $workOrder->updated_by = '1';
            $workOrder->save();

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
                        
                        if(file_exists($foldername))
                        {
                            if(file_exists($foldername2)==false)
                            {
                                if(file_exists($foldername3)==false)
                                {
                                    mkdir($foldername3, 777, true);
                                }
                            }
                        }
                        else
                        {
                            mkdir($foldername, 777, true);
                            mkdir($foldername2, 777, true);
                            mkdir($foldername3, 777, true);
                        }
                        
                        //store file inlocaly
                        $file->move(public_path($foldername3), $filename);
                        $workOrderImages = New WorkOrderImages();
                        $workOrderImages->image = $foldername3.'/'.$filename;
                        $workOrderImages->workorder_id = $request->id;
                        $workOrderImages->user_id = '1';
                        $workOrderImages->title = $request->title;
                        $workOrderImages->type = $request->type; // {0=> Before, 1=> After}
                        $workOrderImages->created_by = '1';
                        $workOrderImages->save();
                        
                        //echo '<pre>'; print_r($workOrderImages); echo '</pre>';
                    }
                    else
                    {
                        return response()->json(['status' => 'false', 'message' => 'invalid_file_format'], 422);
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
