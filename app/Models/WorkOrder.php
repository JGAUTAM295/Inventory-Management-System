<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class WorkOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [ 'created_at', 'updated_at','deleted_at' ];

    public function staff()
    {
        return $this->belongsTo('App\Models\User', 'staff_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\User', 'client_id', 'id');
    }
}
