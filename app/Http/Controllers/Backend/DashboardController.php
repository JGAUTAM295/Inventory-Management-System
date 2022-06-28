<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inventory;
use App\Models\WorkOrder;
use Carbon\Carbon;
use DB, Auth;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_RegisterUsers = User::where('permissionid', env('USER_PERMISSIONID'))->count();
        
        $count_staff = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'staff');
        })->count();

        $count_client = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'client');
        })->count();

        $count_Inventories = Inventory::where('status', '1')->count();

        $cancel_orders = WorkOrder::where('status', '1')->groupBy('status')
        ->select('status', DB::raw('count(*) as count_cancel'))
        ->get()->toArray();
        $cancel_orders[0]['status'] = 'cancel';
        
        $pending_orders = WorkOrder::where('status', '2')->groupBy('status')
        ->select('status', DB::raw('count(*) as count_pending'))
        ->get()->toArray();
        $pending_orders[0]['status'] = 'pending';

        $processing_orders = WorkOrder::where('status', '3')->groupBy('status')
        ->select('status', DB::raw('count(*) as count_processing'))
        ->get()->toArray();
        $processing_orders[0]['status'] = 'processing';

        $complete_orders = WorkOrder::where('status', '4')->groupBy('status')
        ->select('status', DB::raw('count(*) as count_complete'))
        ->get()->toArray();
        $complete_orders[0]['status'] = 'complete';

        $year = date('Y');
        $staffUserForChart = $this->staffUsers($year);
        $clientUserForChart = $this->clientUsers($year);

        $neworders= WorkOrder::where('status', '!=', '4')->latest()->count();
        
        $date = Carbon::now();
        $currentmonth = WorkOrder::where([ ['user_id', Auth::user()->id]])->whereDate('created_at', '>=', $date->copy()->startOfMonth())->whereDate('created_at', '<=', $date->copy()->endOfMonth())->get();
        $lastmonth = WorkOrder::where([['user_id', Auth::user()->id]])->whereDate('created_at', '>=', $date->copy()->startOfMonth()->subMonth())->whereDate('created_at', '<=', $date->copy()->endOfMonth()->subMonth())->get();
        $anothermonth = WorkOrder::where([['user_id', Auth::user()->id]])->whereDate('created_at', '>=', $date->copy()->startOfMonth()->subMonths(2))->whereDate('created_at', '<=', $date->copy()->endOfMonth()->subMonths(2))->get();

    $data = [
        [ 'year'=> $date->year . '-' . $date->copy()->startOfMonth()->subMonths(2)->format('m'), 'value'=> $anothermonth->sum('price') ],
        [ 'year'=> $date->year . '-' . $date->copy()->startOfMonth()->subMonth()->format('m'), 'value'=> $lastmonth->sum('price') ],
        [ 'year'=> $date->year . '-' . $date->copy()->format('m'), 'value'=> $currentmonth->sum('price') ],
    ];

    $workorderjson = json_encode($data);

    $newworkorder = WorkOrder::selectRaw('DATE_FORMAT(orderdate, "%b") as month, COUNT(*) as total')
    ->groupBy('month')
    ->orderByRaw('MONTH(orderdate)')
    ->getQuery()
    ->get()
    ->mapWithKeys(function ($row) {
        return [$row->month => $row->total];
    })
    ->toJson();

        // dd($cancel_orders, $pending_orders, $processing_orders, $complete_orders);
       // echo '<pre>'; print_r($newworkorder); echo '</pre>';

        return view('backend.dashboard', compact('neworders', 'count_staff', 'count_client', 'count_RegisterUsers','count_Inventories', 'workorderjson', 'staffUserForChart','clientUserForChart','cancel_orders','pending_orders','processing_orders','complete_orders'));
    }

    public function clientUsers($year)
    {
        $clientUser = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'client');
        })->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        
        return (array_values($clientUser));
    }
    
    public function staffUsers($year)
    {
        $staffUser = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'staff');
        })->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        
        return (array_values($staffUser));
    }

    public function clientStaff()
    {
        $year = request()->year;
        return [
            'active'=>$this->clientUsers($year),
            'trial'=> $this->staffUsers($year)
        ];
    }



}
