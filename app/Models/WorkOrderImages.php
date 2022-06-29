<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class WorkOrderImages extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [ 'created_at', 'updated_at','deleted_at' ];

}
