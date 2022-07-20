<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\JobOrder;
use App\Models\WorkOrder;

class EquipmentIssueLogging extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $dates = [ 'created_at', 'updated_at','deleted_at' ];
    
    public function equipment()
    {
        return $this->belongsTo('App\Models\Equipment', 'equipment_id', 'id');
    }
    
    public function staff()
    {
        return $this->belongsTo('App\Models\User', 'staff_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Inventory', 'client_id', 'id');
    }
    
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_no', 'department_no');
    }
    
    //Check Work Order Meta Data Exists Or Not Via Equipment Issue Logging ID
    public function checkWorkOrderExits($data)
    {
        $workorder = JobOrder::where('eilid', $data)->count();

        if($workorder == 0)
        {
            $wo = '<a class="btn btn-primary btn-sm" href="';
            $wo .= route("equipment_issues_order.create", $data) ;
            $wo .='"><i class="fas fa-plus"></i> Create Work Order</a>';
        }
        else
        {
            $wo = '<a class="btn btn-primary btn-sm" href="';
            $wo .= route("equipment_issues_order.index", $data) ;
            $wo .='"><i class="fas fa-eye"></i> View Work Order</a>';
        }
        
        return $wo;
    }

}
