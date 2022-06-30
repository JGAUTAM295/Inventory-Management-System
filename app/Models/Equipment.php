<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Taxonomy;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function inventory()
    {
        return $this->belongsTo('App\Models\Inventory', 'inventory_id', 'id');
    }

    public function taxonomy($data)
    {
        $taxonomy = Taxonomy::find($data);

        if(!empty($taxonomy))
        {
            return $taxonomy->name;
        }
       
    }

}
