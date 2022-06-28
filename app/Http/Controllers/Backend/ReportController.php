<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Equipment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Work order status report
    public function work_order_status(Request $request) 
    {
        $data = [];

        // sets the start date at index 0 and ending date at index 1
        $date = explode(' - ', $request->date);

        $Order = WorkOrder::with('users');
        $order = $Order->whereBetween('created_at', $date)
            ->orderBy('created_at', 'desc')
            ->get();

        $data = [
            'orders' => $order,
        ];
        // return $data['orders'];
        return view('work_order.report_list', $data);
    }

    // Equipment report 
    public function equipment_report() 
    {

    }

    // Employees report
    public function employees_report() 
    {

    }
}
