<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Helpers\Helper;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Inventory;
use App\Models\EquipmentIssueLogging;
use App\Models\WorkOrder;
use App\Models\ContactForm;
use App\Models\adminMail;
use App\Models\Notification;
use Carbon\Carbon;
use DB, Auth, Session;

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
        $role = Role::findOrFail(Auth::user()->roles->first()->id);
        $groupsWithRoles = $role->getPermissionNames()->toArray();
        
        $count_RegisterUsers = User::where('permissionid', env('USER_PERMISSIONID'))->count();
        
        $count_staff = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'staff');
        })->count();

        $count_client = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'client');
        })->count();

        $count_Inventories = Inventory::where('status', '1')->count();

        $cancel_orders = EquipmentIssueLogging::where('status', '1')->groupBy('status')
        ->select('status', DB::raw('count(*) as count_cancel'))
        ->get()->toArray();
        $cancel_orders[0]['status'] = 'cancel';
        
        $pending_orders = EquipmentIssueLogging::where('status', '2')->groupBy('status')
        ->select('status', DB::raw('count(*) as count_pending'))
        ->get()->toArray();
        $pending_orders[0]['status'] = 'pending';

        $processing_orders = EquipmentIssueLogging::where('status', '3')->groupBy('status')
        ->select('status', DB::raw('count(*) as count_processing'))
        ->get()->toArray();
        $processing_orders[0]['status'] = 'processing';

        $complete_orders = EquipmentIssueLogging::where('status', '4')->groupBy('status')
        ->select('status', DB::raw('count(*) as count_complete'))
        ->get()->toArray();
        $complete_orders[0]['status'] = 'complete';

        $year = date('Y');
        
        $staffUserForChart = $this->staffUsers($year);
        $clientUserForChart = $this->clientUsers($year);
        
        // cancelWork, pendingWork, processing Work and completeWork
        
        $cancelWork = $this->cancelWork($year);
        $pendingWork = $this->pendingWork($year);
        $processingWork = $this->processingWork($year);
        $completeWork = $this->completeWork($year);
        
        //
        $neworders= EquipmentIssueLogging::where('status', '!=', '4')->latest()->count();
        
        $date = Carbon::now();
        $currentmonth = EquipmentIssueLogging::where([ ['user_id', Auth::user()->id]])->whereDate('created_at', '>=', $date->copy()->startOfMonth())->whereDate('created_at', '<=', $date->copy()->endOfMonth())->get();
        $lastmonth = EquipmentIssueLogging::where([['user_id', Auth::user()->id]])->whereDate('created_at', '>=', $date->copy()->startOfMonth()->subMonth())->whereDate('created_at', '<=', $date->copy()->endOfMonth()->subMonth())->get();
        $anothermonth = EquipmentIssueLogging::where([['user_id', Auth::user()->id]])->whereDate('created_at', '>=', $date->copy()->startOfMonth()->subMonths(2))->whereDate('created_at', '<=', $date->copy()->endOfMonth()->subMonths(2))->get();

    $data = [
        [ 'year'=> $date->year . '-' . $date->copy()->startOfMonth()->subMonths(2)->format('m'), 'value'=> $anothermonth->sum('price') ],
        [ 'year'=> $date->year . '-' . $date->copy()->startOfMonth()->subMonth()->format('m'), 'value'=> $lastmonth->sum('price') ],
        [ 'year'=> $date->year . '-' . $date->copy()->format('m'), 'value'=> $currentmonth->sum('price') ],
    ];

    $workorderjson = json_encode($data);

    $userss = User::select('id', 'created_at')->get()->groupBy(function ($date) {
        return Carbon::parse($date->created_at)->format('m');
    });
    
    $usermcount = [];
    $userArr = [];
    
    foreach ($userss as $key => $value) {
        $usermcount[(int)$key] = count($value);
    }
    
    $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
    for ($i = 1; $i <= 12; $i++) {
        if (!empty($usermcount[$i])) {
            $userArr[$i]['count'] = $usermcount[$i];
        } else {
            $userArr[$i]['count'] = 0;
        }
        
        $userArr[$i]['month'] = $month[$i - 1];
    }

    $user_monthwise = json_encode(array_values($userArr));
    
    if(Auth::user()->roles->first()->name == 'Staff')
    {
        $order_all = EquipmentIssueLogging::select('id', 'created_at')->where('staff_id', Auth::user()->id)->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });
    }
    elseif(Auth::user()->roles->first()->name == 'Client')
    {
        $order_all = EquipmentIssueLogging::select('id', 'created_at')->where('client_id', Auth::user()->id)->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });
    }
    elseif(Auth::user()->roles->first()->name == 'admin' || Auth::user()->roles->first()->name == 'Super-Admin')
    {
        $order_all = EquipmentIssueLogging::select('id', 'created_at')->where('user_id', Auth::user()->id)->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });
    }
    else
    {
        $order_all = EquipmentIssueLogging::select('id', 'created_at')->where('user_id', Auth::user()->id)->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });
    }
    
    $ordermcount = [];
    $orderArr = [];
    
    foreach ($order_all as $key => $value) {
        $ordermcount[(int)$key] = count($value);
    }
    
    for ($i = 1; $i <= 12; $i++) {
        if (!empty($ordermcount[$i])) {
            $orderArr[$i] = $ordermcount[$i];
        } else {
            $orderArr[$i] = 0;
        }
        
        //$orderArr[$i]['month'] = $month[$i - 1];
    }

    $order_monthwise = json_encode(array_values($orderArr));
    
        // $equipment_issues = WorkOrder::select([
        //                     DB::raw('DATE(created_at) AS date'),
        //                     DB::raw('COUNT(id) AS count'),
        //                  ])
        //                  ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
        //                  ->groupBy('date')
        //                  ->orderBy('date', 'ASC')
        //                  ->get()
        //                  ->toArray();
                         
    $equipment_issues = EquipmentIssueLogging::select('*')->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])->orderBy('created_at', 'ASC')->limit('10')->get();
 
    //  echo '<pre>'; print_r($equipment_issues); echo '</pre>';
    //  die;

       return view('backend.dashboard', compact('groupsWithRoles', 'equipment_issues', 'neworders', 'count_staff', 'count_client', 'count_RegisterUsers', 'count_Inventories', 'user_monthwise', 'order_monthwise', 'staffUserForChart', 'clientUserForChart', 'cancelWork', 'pendingWork', 'processingWork', 'completeWork', 'cancel_orders','pending_orders','processing_orders','complete_orders'));
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

    public function workorder()
    {
        $year = request()->year;
        return [
            'cancel'=>$this->cancelWork($year),
            'pending'=> $this->pendingWork($year),
            'processing'=> $this->processingWork($year),
            'completed'=> $this->completeWork($year)
        ];
    }
    
    public function cancelWork($year)
    {
        if(Auth::user()->roles->first()->name == 'Staff')
        {
         $cancelorders = EquipmentIssueLogging::where('staff_id', Auth::user()->id)
         ->where('status', '1')
         ->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        }
        elseif(Auth::user()->roles->first()->name == 'Client')
        {
         $cancelorders = EquipmentIssueLogging::where('client_id', Auth::user()->id)
         ->where('status', '1')
         ->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        }
        else
        {
            $cancelorders = EquipmentIssueLogging::where('status', '1')
         ->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        }
        
        return (array_values($cancelorders));
    }
    
    public function pendingWork($year)
    {
        if(Auth::user()->roles->first()->name == 'Staff')
        {
         $pendingorders = EquipmentIssueLogging::where('staff_id', Auth::user()->id)
         ->where('status', '2')
         ->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        }
        elseif(Auth::user()->roles->first()->name == 'Client')
        {
         $pendingorders = EquipmentIssueLogging::where('client_id', Auth::user()->id)
         ->where('status', '2')
         ->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        }
        else
        {
         $pendingorders = EquipmentIssueLogging::where('status', '2')
         ->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();   
        }
        
        return (array_values($pendingorders));
    }
    
    public function processingWork($year)
    {
        if(Auth::user()->roles->first()->name == 'Staff')
        {
         $processingorders = EquipmentIssueLogging::where('staff_id', Auth::user()->id)
         ->where('status', '3')
         ->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        }
        elseif(Auth::user()->roles->first()->name == 'Client')
        {
         $processingorders = EquipmentIssueLogging::where('client_id', Auth::user()->id)
         ->where('status', '3')
         ->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        }
        else
        {
        $processingorders = EquipmentIssueLogging::where('status', '3')
         ->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        }
        
        return (array_values($processingorders));
    }
    
    public function completeWork($year)
    {
        if(Auth::user()->roles->first()->name == 'Staff')
        {
         $completeorders = EquipmentIssueLogging::where('staff_id', Auth::user()->id)
         ->where('status', '4')
         ->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        }
        elseif(Auth::user()->roles->first()->name == 'Client')
        {
         $completeorders = EquipmentIssueLogging::where('client_id', Auth::user()->id)
         ->where('status', '4')
         ->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        }
        else
        {
            $completeorders = EquipmentIssueLogging::where('status', '4')
         ->orderBy('created_at')->whereYear('created_at', $year)->get()
            ->groupBy(function ($date) {
                return $date->created_at->month;
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->union(array_fill(1, 12, 0))
            ->sortKeys()
            ->toArray();
        }
        
        return (array_values($completeorders));
    }
    
    //Send Mail From Staff or client
    public function contactstore(Request $request)
    {
        // echo ''; print_r($request->all()); echo '';
        
        $validator = Validator::make($request->all(), [
            'title'  => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails())
        {
            return response() -> json(['status' => 401, 'data' => $validator->errors()->first()]);
        }
        else
        {
            if(!empty(Helper::websetting('sitename')))
            {
               $sitename = Helper::websetting('sitename');
            }
            else
            {
                $sitename = "IMES";
            }
            
            $to = env('ADMIN_EMAIL');
            $subject = 'Contact Form Enquiry '.date('d M, Y h:i:s A');
            
            $headers = '';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: IMES <info@imes.com>' . "\r\n";
            $message  = '<!DOCTYPE html><html><head><title>'.$sitename.' | Contact Form Enquiry</title></head><body>';
            $message .= '<table width=100% border=0><tr><td>';
            $message .= '<tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>'.$sitename.'</font><h2></td></tr>';
            $message .= '<tr><td colspan=2><br/><br/><br/><strong>To IMES TEAM,</strong></td></tr>';
            $message .= '<tr><td colspan=2><br/><font size=3><b>Title/Subject: </b>'.$request->title.'</font></td></tr>';
            $message .= '<tr><td colspan=2><br/><font size=3><b>Message: </b>'.$request->message.'</font></td></tr>';
            $message .= '<tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>'.Auth::user()->name.'</font></td></tr></table></body></html>';
    
            if(mail('jyoti.610weblab@gmail.com', $subject, $message, $headers))
            {
                $cf = New ContactForm();
                $cf->user_id = Auth::user()->id;
                $cf->title = $request->title;
                $cf->message = $request->message;
                $cf->email_msg = $message;
                $cf->created_by = Auth::user()->id;
                
                if($cf->save())
                {
                    $adminUser = User::whereHas('roles', function ($q) {
                        $q->where('name', '=', 'admin');
                    })->get();
                    
                    foreach($adminUser as $adminuser)
                    {
                        if(!empty($adminuser->device_token))
                        {
                            //$admin_mail = $this->mailNotification($adminuser->device_token);
                            Helper::fcmNotification($adminuser->device_token);
                        }
                        
                    }
                    
                    $superadminUser = User::whereHas('roles', function ($q) {
                        $q->where('name', '=', 'Super-Admin');
                    })->get();
                    
                    foreach($superadminUser as $superadmin)
                    {
                        if(!empty($superadmin->device_token))
                        {
                            //$superadmin_mail = $this->mailNotification($superadmin->device_token);
                            Helper::fcmNotification($superadmin->device_token);
                        }
                        
                    }
                    
                    return response() -> json(['status' => 200, 'data' => 'Message Sent!']);
                    
                }
            }
            else
            {
                return response() -> json(['status' => 401, 'data' => 'Message Not Sent!']);
            }
        
           
        }
    }
    
    //reply Mail From Admin
    public function replymessage(Request $request)
    {
        // echo ''; print_r($request->all()); echo '';
        
        $validator = Validator::make($request->all(), [
            'id'  => 'required',
            'email'  => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails())
        {
            return response() -> json(['status' => 401, 'data' => $validator->errors()->first()]);
        }
        else
        {
             $cf = ContactForm::find($request->id);
             
            if(!empty(Helper::websetting('sitename')))
            {
               $sitename = Helper::websetting('sitename');
            }
            else
            {
                $sitename = "IMES";
            }
            
            $to = $request->email;
            $subject = 'Contact Form Enquiry '.date('d M, Y h:i:s A');
            
            $headers = '';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: IMES <info@imes.com>' . "\r\n";
            $message  = '<!DOCTYPE html><html><head><title>'.$sitename.' | Contact Form Enquiry</title></head><body>';
            $message .= '<table width=100% border=0><tr><td>';
            $message .= '<tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>'.$sitename.'</font><h2></td></tr>';
            $message .= '<tr><td colspan=2><br/><br/><br/><strong>Hello '.User::find($cf->user_id)->name.',</strong></td></tr>';
            $message .= '<tr><td colspan=2><br/><font size=3><b>Message: </b>'.$request->message.'</font></td></tr>';
            $message .= '<tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>';
    
            if(mail($to, $subject, $message, $headers))
            {
                $newcf = New adminMail();
                $newcf->user_id = $cf->user_id;
                $newcf->msg_id = $cf->id;
                $newcf->title = $cf->title;
                $newcf->message = $request->message;
                $newcf->email_msg = $message;
                $newcf->created_by = Auth::user()->id;
                
                if($newcf->save())
                {
                    //$this->mailNotification(User::find($cf->user_id)->device_token);
                    Helper::fcmNotification(User::find($cf->user_id)->device_token);
                    return response() -> json(['status' => 200, 'data' => 'Message Sent!', 'message' => $message]);
                }
            }
            else
            {
                return response() -> json(['status' => 401, 'data' => 'Message Not Sent!']);
            }
        
           
        }
    }
    
    public function mail()
    {
        $role = Role::findOrFail(Auth::user()->roles->first()->id);
        $groupsWithRoles = $role->getPermissionNames()->toArray();
        
        if(Auth::user()->hasRole('admin|Super-Admin'))
        {
            // $umails = ContactForm::get();
            // $unique = $umails->unique('user_id');
            // $mails = $unique->values()->all();
            
            $mails = ContactForm::orderBy('id', 'DESC')->get();
                     
            return view('backend.mail.mail', compact('mails', 'groupsWithRoles'));
        }
        elseif(Auth::user()->hasRole('Staff|Client'))
        {
            // $umails = ContactForm::where('user_id', Auth::user()->id)->get();
            // $unique = $umails->unique('user_id');
            // $mails = $unique->values()->all();
            
            $mails = ContactForm::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
                     
            return view('backend.mail.mail', compact('mails', 'groupsWithRoles'));
        }
        else
        {
            return redirect()->route('dashboard');  
        }
        
    }
    
    public function readmail($id)
    {
        $role = Role::findOrFail(Auth::user()->roles->first()->id);
        $groupsWithRoles = $role->getPermissionNames()->toArray();
        
        $mail = ContactForm::find($id);
        $adminmail = adminMail::where('msg_id', $id)->first();
        
        if($role->name == 'Super-Admin')
        {
            if(!empty($adminmail))
            {
                $adminmail->read_at = '1';
                $adminmail->save();
            }
            
            if(!empty($mail))
            {
                $mail->admin_read_at = '1';
                $mail->save();
            }
        }
        else
        {
           $mail->read_at = '1'; 
           $mail->save();
        }
        
        return view('backend.mail.read_mail', compact('mail', 'adminmail', 'groupsWithRoles'));
    }
    
    public function destorymail($id)
    {
        $mail = ContactForm::find($id);
        
        if($mail->delete())
        {
            return back()->with('success', 'Mail has been deleted successfully!');
        }
        
    }
    
    // GET NOTIFICATIONS FROM API
    public function notifications_list()
    {
        if (Auth::check()) 
        {
            $role = Role::findOrFail(Auth::user()->roles->first()->id);
            $groupsWithRoles = $role->getPermissionNames()->toArray();
              
            $response = Notification::select('id', 'title', 'description', 'icon', 'type', 'url', 'read_at')->where('user_id', Auth::user()->id)->orderBy('id','ASC')->get(); // read_at => 1 & unread => 0
        
            // $url = url('/api/notifications');
            // $response = $this->php_curl($url);
            // echo '<pre>'; print_r($response); echo '</pre>';
            
            return view('backend.notifications.list', compact('groupsWithRoles', 'response'));
        }
        else
        {
            return redirect()->route('login');
        }
         
    }
    
    public function notifications_destroy($id)
    {
        if (Auth::check()) 
        {
            $notification = Notification::where([ ['id', '=', $id], ['user_id', '=', Auth::user()->id] ])->first();
              
            if($notification->delete())
            {
                return back()->with('success', $notification->name.' Notification has been deleted successfully!');
            }
        }
        else
        {
            return redirect()->route('login');
        }
    }
    
    public function notifications_clear()
    {
        if (Auth::check()) 
        {
            if(Notification::where('user_id', Auth::user()->id)->delete())
            {
                  return back()->with('success', 'All Notification has been deleted successfully!');
            }
        }
        else
        {
            return redirect()->route('login');
        }
    }
    
    public function contactindex()
    {
        $role = Role::findOrFail(Auth::user()->roles->first()->id);
        $groupsWithRoles = $role->getPermissionNames()->toArray();
        
        return view('backend.contact.index', compact('groupsWithRoles'));
    }
    
    
    public function php_curl($url)
    {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.Session::get('accessToken')
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        return json_decode($response);
    }
    
}
