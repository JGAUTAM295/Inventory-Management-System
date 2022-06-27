<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Equipment;
use App\Models\Taxonomy;
use App\Models\TaxonomyData;
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
        $work_orders = WorkOrder::orderBy('id','DESC')->get();
        return view('backend.work_order.list', compact('work_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'staff');
        })->where('status', '1')->orderBy('id','DESC')->get();
        
        return view('backend.work_order.add', compact('users'));
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
            $newWorkOrder->orderdate = date('Y-m-d H:i:s', strtotime($request->orderdate));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOrder $workOrder)
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'staff');
        })->where('status', '1')->orderBy('id','DESC')->get();

        return view('backend.work_order.edit', [ 'work_order' => $workOrder,  'users' => $users ]);
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
        $workOrder->orderdate = date('Y-m-d H:i:s', strtotime($request->orderdate));
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
}
