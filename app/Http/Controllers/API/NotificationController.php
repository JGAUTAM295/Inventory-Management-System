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
use App\Models\Notification;
use Illuminate\Support\Str;
use Auth, Hash, DB, File;

class NotificationController extends BaseController
{
    
    //GET NOTIFICATIONS
    public function index()
    {
        if (Auth::check()) 
        {
            $notifications = Notification::select('id', 'title', 'description', 'icon', 'type', 'read_at')->where('user_id', Auth::user()->id)->orderBy('id','ASC')->get()->toArray(); // read_at => 1 & unread => 0
            
            if(!empty($notifications))
            {
               return $this->handleResponse($notifications);  
            }
            else
            {
                return $this->handleError('No Notification Found!');
            }
        }
        
    }
    
    //UPDATE NOTIFICATIONS VIA ID (READ_AT Column)
    
    public function readnotification($id)
    {
        if (Auth::check()) 
        {
            // if(Auth::user()->hasRole('admin|Super-Admin'))
            // {
            //     $notification = Notification::where('id', $id)->first();
            // }
            // else
            // {
                $notification = Notification::where([ ['id', '=', $id], ['user_id', '=', Auth::user()->id] ])->update(['read_at' => '1']);
           // }
            if($notification)
            {
                $notification = Notification::select('id', 'title', 'description', 'icon', 'type', 'read_at')->where([['id', '=', $id], ['user_id', '=', Auth::user()->id] ])->first();
                
                return $this->handleResponse($notification, $notification->title.' Notification has been read!');
            }
            else
            {
                 return $this->handleError('No Notification Found!');
            }
        }
        
    }
    
    // DELETE NOTIFICATIONS VIA ID & AUTH USER ID
    public function deletenotification($id)
    {
        if (Auth::check()) 
        {
            // if(Auth::user()->hasRole('admin|Super-Admin'))
            // {
            //     $notification = Notification::where('id', $id)->first();
            // }
            // else
            // {
                $notification = Notification::where([ ['id', '=', $id], ['user_id', '=', Auth::user()->id] ])->first();
            //}
            
            if($notification->delete())
            {
                return $this->handleResponse(null, $notification->title.' Notification has been deleted successfully!');
            }
            else
            {
                return $this->handleError($notification->title.' Notification not deleted successfully!');
            }
        }
        
    }
    
    // DELETE ALL NOTIFICATIONS VIA AUTH USER ID
    public function destroyallnotification()
    {
        if (Auth::check()) 
        {
        // if(Auth::user()->hasRole('admin|Super-Admin'))
        // {
        //     if(Notification::delete())
        //     {
        //         return $this->handleResponse(null, 'All Notification has been deleted successfully!'); 
        //     }
        //     else
        //     {
        //         return $this->handleError('Notification not deleted successfully!');
        //     }
        // }
        // else
        // {
            if(Notification::where('user_id', Auth::user()->id)->delete())
            {
                return $this->handleResponse(null, 'All Notification has been deleted successfully!'); 
            }
            else
            {
                return $this->handleError('Notification not deleted successfully!');
            }
        //}
        }
    }
  
}
