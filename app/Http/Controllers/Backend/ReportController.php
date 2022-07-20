<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Equipment;
use App\Models\Taxonomy;
use Illuminate\Http\Request;
use Auth;

class ReportController extends Controller
{
    // Work order status report
    public function work_order_status(Request $request) 
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

            return view('backend.reports.work_order_status_report', compact('work_orders'));
        }
        else
        {
            return redirect()->route('dashboard');
        }

        
    }

    // Equipment report 
    public function equipment_report() 
    {
        $equipments = Equipment::orderBy('id','DESC')->get();
        $cf = Taxonomy::where('input_field_type', '!=', 'File')->where('status', '1')->orderBy('order_no','ASC')->get();
        
        $fieldcolname = array();
        
        foreach($cf as $cf_list){
            $fieldcolname[] = $cf_list->slug.'='.$cf_list->id;
        }
        
        return view('backend.reports.equipment_report', compact('equipments', 'fieldcolname'));
    }

    // Employees report
    public function employees_report() 
    {
        $staffs = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'staff');
        })->orderBy('id','DESC')->get();
        
        return view('backend.reports.employees_report',compact('staffs'));
    }
}
