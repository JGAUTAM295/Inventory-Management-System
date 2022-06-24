<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TaxonomyData;

class Taxonomy extends Model
{
    use HasFactory;

    //Check Taxonomy Data Exists Or Not Via Taxonomy ID
    public function checkTDexits($data)
    {
        $taxonomyData = TaxonomyData::where('taxonomy_id', $data)->count();

        if($taxonomyData == 0){
            $txyd = '<i class="fas fa-plus"></i> Add Data';
        }
        else
        {
            $txyd = '<i class="fas fa-eye"></i> View List';  
        }
        
        return $txyd;
    }

    //Check Taxonomy Data Exists Or Not Via Taxonomy ID
    public function getTaxonomyData($data)
    {
        $taxonomyData = TaxonomyData::where('taxonomy_id', $data)->get();
        
        return $taxonomyData;
    }
}
