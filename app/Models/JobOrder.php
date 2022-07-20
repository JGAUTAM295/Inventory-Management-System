<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrder extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $dates = [ 'created_at', 'updated_at','deleted_at' ];
    
    public function jobperformed()
    {
        return $this->belongsTo('App\Models\User', 'job_performed_by', 'id');
    }
}
