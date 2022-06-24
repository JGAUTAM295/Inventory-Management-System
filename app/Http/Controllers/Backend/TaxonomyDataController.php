<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Equipment;
use App\Models\Taxonomy;
use App\Models\TaxonomyData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class TaxonomyDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('backend.inventories.equipments.taxonomies.data.add', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required|unique:taxonomy_data,name,NULL,id,taxonomy_id,' . $id,
            'status' => 'required'
        ]);

        if ($validator->fails())
        {
            $taxonomy = Taxonomy::find($id);
            return view('backend.inventories.equipments.taxonomies.data.add', compact('taxonomy', 'id'))->withErrors($validator->errors());
        }
        else
        {
            $newTaxonomyData = New TaxonomyData();
            $newTaxonomyData->taxonomy_id = $id;
            $newTaxonomyData->name = $request->name;
            $newTaxonomyData->status = $request->status;
            $newTaxonomyData->created_by = Auth::user()->id;
         
            if($newTaxonomyData->save())
            {
                return redirect()->route('taxonomy.show', $id)->withSuccess(__($request->name.' Taxonomy Data created successfully.'));
            }
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaxonomyData  $taxonomyData
     * @return \Illuminate\Http\Response
     */
    public function show(TaxonomyData $taxonomyData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaxonomyData  $taxonomyData
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $tdid)
    {
        $taxonomy = Taxonomy::find($id);
        $taxonomyData = TaxonomyData::find($tdid);

        return view('backend.inventories.equipments.taxonomies.data.edit', compact('taxonomy', 'taxonomyData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaxonomyData  $taxonomyData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaxonomyData $taxonomyData)
    {
        $request->validate([
            'name'   => 'required|unique:taxonomy_data,name,NULL,id,taxonomy_id,' . $request->route('id'),
            'status' => 'required',
        ]);

        $taxonomyData = TaxonomyData::find($request->route('tdid'));
        $taxonomyData->name = $request->name;
        $taxonomyData->status = $request->status;
        $taxonomyData->updated_by = Auth::user()->id;
   
        if($taxonomyData -> save())
        {
            return redirect()->route('taxonomy.show', $request->route('id'))->with('success', $request->name.' Taxonomy has been updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaxonomyData  $taxonomyData
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $tdid)
    {
        $taxonomyData = TaxonomyData::find($tdid);
        if($taxonomyData -> delete()){
            return back()->with('success', $taxonomyData->name.' Taxonomy Data has been deleted successfully!');
        }
    }
}
