<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipment;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'status',
    ];

    //Check Equipment Data Exists Or Not Via Inventory ID
    public function checkEquipExits($data)
    {
        $equipment = Equipment::where('inventory_id', $data)->count();

        if($equipment == 0){
            $equip = '<i class="fas fa-plus"></i> Add Data';
        }
        else
        {
            $equip = '<i class="fas fa-eye"></i> View List';  
        }
        
        return $equip;
    }
}
