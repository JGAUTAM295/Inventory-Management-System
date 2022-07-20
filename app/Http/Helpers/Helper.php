<?php
namespace App\Http\Helpers;
use App\Models\WebSetting;
use App\Models\ContactForm;
use App\Models\adminMail;
use App\Models\MenuItem;
use App\Models\Menus;
use App\Models\User;
use App\Models\Equipment;
use App\Models\EquipmentIssueLogging;
use App\Models\Inventory;
use App\Models\Notification;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;

class Helper {
    
    //Dynamic Website header
    public static function websetting($data) {
        $res = WebSetting::where('option_title','header')->first();
        
        $header = json_decode($res->option_value, true);
        
        $web_header = $header[$data];
        
        return $web_header;
    }
    
    //Dynamic Navbar menu
    public static function navbar_menu($userRole) 
    {
        $role = Role::findOrFail(Auth::user()->roles->first()->id);
        $groupsWithRoles = $role->getPermissionNames()->toArray();
        
        $menus = Menus::where('user_role', 'LIKE', "%{$userRole}%")->where('status', '1')->orderBy('menu_order', 'ASC')->get();
        
        if($role->name == 'Super-Admin')
        {
           $count = ContactForm::where('admin_read_at', '0')->count(); 
        }
        else
        {
            $count = ContactForm::where([['user_id', Auth::user()->id], ['read_at', '0']])->count();
        }
        
        foreach($menus as $menu)
        {
            //Get Route Name By URL
            $parentrouteName = app('router')->getRoutes()->match(app('request')->create($menu->url, 'get'))->getName();
                        
            if(in_array($parentrouteName, $groupsWithRoles)) 
            {
                if($menu->url == '/mail')
                {
                    echo '<li class="nav-item"><a href="'.$menu->url.'" class="nav-link"><i class="nav-icon '.$menu->faicon.'"></i><p>'.$menu->menu_item.'<span class="right badge badge-danger">'.$count.'</span>';
                }
                else
                {
                    echo '<li class="nav-item"><a href="'.$menu->url.'" class="nav-link"><i class="nav-icon '.$menu->faicon.'"></i><p>'.$menu->menu_item;
                }
                
                
                if($menu->child_menu == 'Yes')
                {
                     echo '<i class="fas fa-angle-left right"></i>';
                }
                  
                 echo'</p></a>';
                
                if($menu->child_menu == 'Yes')
                {
                    $menu_items = explode(',', $menu->parent_menu);
                     echo '<ul class="nav nav-treeview">';
                    
                    foreach($menu_items as $menu_item)
                    {
                        $menuitem = MenuItem::find($menu_item);
                        
                        //Get Route Name By URL
                        $routeName = app('router')->getRoutes()->match(app('request')->create($menuitem->url, 'get'))->getName();
                        
                        if(in_array($routeName, $groupsWithRoles))
                        {
                            echo '<li class="nav-item"><a href="'.url($menuitem->url).'" class="nav-link"><i class="far fa-circle nav-icon"></i><p>'.$menuitem->name.'</p></a></li>';
                        }
                    
                    }
                    
                     echo '</ul>';
                }
                
                echo '</li>';
            }
        }
    }
    
    // Send Mail For Equipment Issue 
    public static function sendMailJobOrder($staff, $subject, $request, $pageurl, $lastID) 
    {
        if(!empty(Helper::websetting('sitename')))
        {
          $sitename = Helper::websetting('sitename');
        }
        else
        {
            $sitename = "IMES";
        }
        
        $subject = 'New Job Order ('. Equipment::find($request['equipment_id'])->title.') '.date('d M, Y h:i:s A');
            
        $headers = '';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: IMES <info@imes.com>' . "\r\n";
        $message  = '<!DOCTYPE html><html><head><title>'.$sitename.' | Equipment Issue </title></head><body>';
        $message .= '<table width=100% border=0><tr><td>';
        $message .= '<tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>'.$sitename.'</font><h2></td></tr>';
        $message .= '<tr><td colspan=2><br/><br/><br/><strong>Hello '.ucwords($staff->name).',</strong></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>'.Equipment::find($request['equipment_id'])->title.'</font></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=3><b>Order Date: </b>'.date('Y-m-d h:i:s', strtotime($request['orderdate'])).'</font></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=3><b>Address: </b>'.Inventory::find($request['client_id'])->address.'</font></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>'.$request['scope_of_work'].'</font></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=3><b>Client Name: </b>'.ucwords(Inventory::find($request['client_id'])->name).'</font></td></tr>';
        $message .= '<tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>';
        
        if(mail($staff->email, $subject, $message, $headers))
        {
            $newcf = New ContactForm();
            $newcf->user_id = $staff->id;
            $newcf->title = Equipment::find($request['equipment_id'])->title;
            $newcf->message = $request['scope_of_work'];
            $newcf->email_msg = $message;
            $newcf->type = 'new_job_order';
            $newcf->created_by = Auth::user()->id;
            
            if($newcf->save())
            {

                $notification = New Notification();
                $notification->user_id = $staff->id;
                $notification->title = Equipment::find($equipment_id)->title;
                $notification->description = 'You have received new equipment issue!';
                $notification->icon = urldecode(url('public'.Helper::websetting('faviconimage')));
                $notification->url = $pageurl;
                $notification->lastid = $lastID;
                $notification->type = 'new_equipment_issue';
                $notification->read_at = '0';
                $notification->created_by = Auth::user()->id;
                $notification->save();
            
                if(!empty($staff->device_token))
                {
                    Helper::fcmNotification($staff->device_token, 'You have received new equipment issue!');
                }
                
                 return true;
            }
           
        }
    }
    
    // Send Mail For New Work Job
    public static function sendMailWorkOrder($staff, $subject, $request, $pageurl, $lastID) 
    {
        $equipment_id = EquipmentIssueLogging::find($request['equipment_id'])->equipment_id;
        
        if(!empty(Helper::websetting('sitename')))
        {
          $sitename = Helper::websetting('sitename');
        }
        else
        {
            $sitename = "IMES";
        }
            
        
        $subject = 'New Work Order ('. Equipment::find($equipment_id)->title.') '.date('d M, Y h:i:s A');
            
        $headers = '';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: IMES <info@imes.com>' . "\r\n";
        $message  = '<!DOCTYPE html><html><head><title>'.$sitename.' | New Work Order</title></head><body>';
        $message .= '<table width=100% border=0><tr><td>';
        $message .= '<tr><td colspan=2 style=position:absolute;left:350;top:60;><h2><font color = #346699>'.$sitename.'</font><h2></td></tr>';
        $message .= '<tr><td colspan=2><br/><br/><br/><strong>Hello '.ucwords($staff->name).',</strong></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=3><b>Title/ Equipment Issue: </b>'.Equipment::find($equipment_id)->title.'</font></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=3><b>Order Date: </b>'.date('Y-m-d h:i:s', strtotime($request['orderdate'])).'</font></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=3><b>Address: </b>'.Inventory::find($request['client_id'])->address.'</font></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=3><b>Scope Of Work: </b>'.$request['scope_of_work'].'</font></td></tr>';
        $message .= '<tr><td colspan=2><br/><font size=3><b>Client Name: </b>'.ucwords(Inventory::find($request['client_id'])->name).'</font></td></tr>';
        $message .= '<tr><td colspan=2><br/><br/><font size=3><b>Best regards,</b><br>IMES TEAM</font></td></tr></table></body></html>';
        
        if(mail($staff->email, $subject, $message, $headers))
        {
            $newcf = New ContactForm();
            $newcf->user_id = $staff->id;
            $newcf->title = Equipment::find($equipment_id)->title;
            $newcf->message = $request['scope_of_work'];
            $newcf->email_msg = $message;
            $newcf->type = 'new_job_order';
            $newcf->created_by = Auth::user()->id;
            
            if($newcf->save())
            {
                $notification = New Notification();
                $notification->user_id = $staff->id;
                $notification->title = Equipment::find($equipment_id)->title;
                $notification->description = 'You have received new job order!';
                $notification->icon = urldecode(url('public'.Helper::websetting('faviconimage')));
                $notification->url = $pageurl;
                $notification->lastid = $lastID;
                $notification->type = 'new_job_order';
                $notification->read_at = '0';
                $notification->created_by = Auth::user()->id;
                $notification->save();
                
                if(!empty($staff->device_token))
                {
                    Helper::fcmNotification($staff->device_token, 'You have received new job order!');
                }
                
                 return true;
            }
           
        }
    }
    
    // FCM/Push notification send to web browser and App
    public static function fcmNotification($token, $body = null)
    {
        $from = "AAAATFUZtsY:APA91bHMmHm4uicdzjW9ffesEkm41shvF2b7Cr5KhqFzFw4MbpyWFs5aRyNtSkQdNAWfTHaS_eiM_eZodrlOfSqn0x9e5j39UDEgvrbeyqoUmPuJYsH8WjmFwk34w9P9pLUfbT61w5nz";
        
        if(!empty($body))
        {
            $des = $body;
            
        }
        else
        {
            $des = "You have received new message!";
        }
        
        $msg = array
            (
                'body'  => $des,
                'title' => Helper::websetting('sitename'),
                'receiver' => Helper::websetting('sitename'),
                'icon'  => urldecode(url('public'.Helper::websetting('faviconimage'))),/*Default Icon*/
                'sound' => 'default'
            );
            
        $fields = array
            (
                'to'        => $token,
                'notification'  => $msg,
                'data'  => $msg
            );

        $headers = array
            (
                'Authorization: key=' . $from,
                'Content-Type: application/json'
            );
            
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        // dd($result);
         return $result;
        curl_close( $ch );
    }
    
    //GET ALL Mails BY AUTH USER
    public static function getLatestMails() 
    {
        $role = Role::findOrFail(Auth::user()->roles->first()->id);
        $groupsWithRoles = $role->getPermissionNames()->toArray();
        
        $mail_url = route('dashboard.mail');
        
        $now = Carbon::now();
        
        if(Auth::user()->hasRole('admin|Super-Admin'))
        {
            $mails = ContactForm::where('read_at', '0')->orderBy('id', 'DESC')->get();
        }
        
        if(Auth::user()->hasRole('Staff|Client'))
        {
            $mails = ContactForm::where([ ['user_id', Auth::user()->id], ['read_at', '0']])->orderBy('id', 'DESC')->get();
        }
        
        echo '<li class="nav-item dropdown"><a class="nav-link" data-toggle="dropdown" href="#"><i class="far fa-comments"></i><span class="badge badge-danger navbar-badge">'.$mails->count().'</span></a>';
        
        if($mails->count() >= '0')
        {
            echo '<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">';
            
            $i=0;
            
            foreach($mails as $mail)
            {
                if($i==6) break;
                
                $created_at = Carbon::parse($mail->created_at);
                $diffHuman = $created_at->diffForHumans($now, true);  // 3 Months ago
                
                $notify_url = route('dashboard.readmail', $mail->id);
               
                $user = User::find($mail->user_id);
                $user_image= url('/').asset($user->image);

                echo '<a href="'.$notify_url.'" id="NOTIFIY_'.$mail->id.'" class="dropdown-item"><div class="media">
              <img src="'.$user_image.'" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                 '.$user->name.'
                </h3><p class="text-sm"><b>'.ucwords($mail->title).'</b><br>'.Str::limit($mail->message, $limit = 50, $end = "...").'</p><p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> '.$diffHuman.'</p></div></div><div class="dropdown-divider"></div>';
                
                $i++;
            }
            
        }
        echo '<div class="dropdown-divider"></div>
          <a href="'.$mail_url.'" class="dropdown-item dropdown-footer">See All Messages</a>
        </div></li>';
    }
    
    //GET ALL NOTIFICATION BY AUTH USER
    public static function getnotification() 
    {
        $role = Role::findOrFail(Auth::user()->roles->first()->id);
        $groupsWithRoles = $role->getPermissionNames()->toArray();
        
        $notify_url = route('dashboard.notificationsList');
        
        $now = Carbon::now();
        
        $notifications = Notification::where([ ['user_id', Auth::user()->id], ['read_at', '0']])->orderBy('id', 'DESC')->limit('5')->get();
        
        echo '<li class="nav-item dropdown"><a class="nav-link" data-toggle="dropdown" href="#"><i class="far fa-bell"></i><span class="badge badge-danger navbar-badge">'.$notifications->count().'</span></a>';
        
        if($notifications->count() >= '0')
        {
            echo '<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right notifiydiv"><span class="dropdown-item dropdown-header">'.$notifications->count().' Notifications</span>';
            
            $i=0;
            
            foreach($notifications as $notification)
            {
                if($i==10) break;
                
                $created_at = Carbon::parse($notification->created_at);
                $diffHuman = $created_at->diffForHumans($now, true);  // 3 Months ago
                
                if(!empty($notification->url))
                {
                    $notify_url = url($notification->url.'?&id='.$notification->id);
                }
                else
                {
                    $notify_url = url('/');
                }

                echo '<div class="dropdown-divider"></div><a href="'.$notify_url.'" id="NOTIFIY_'.$notification->id.'" class="dropdown-item"><i class="fas fa-envelope mr-2"></i> '.$notification->title;
                echo '<span class="float-right text-muted text-sm">'.$diffHuman.'</span></a>';
                
                $i++;
            }
            
        }
       
        echo '<div class="dropdown-divider"></div><a href="'.$notify_url.'" class="dropdown-item dropdown-footer">See All Notifications</a></div></li>';
    }
}