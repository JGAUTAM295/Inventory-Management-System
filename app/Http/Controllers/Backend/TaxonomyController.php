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

class TaxonomyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taxonomies = Taxonomy::orderBy('id','DESC')->get();
        return view('backend.inventories.equipments.taxonomies.list', compact('taxonomies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.inventories.equipments.taxonomies.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:taxonomy_data,name',
            'input_field_type' => 'required',
            'input_required' => 'required',
            'order_no' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails())
        {
             return view('backend.inventories.equipments.taxonomies.list')->withErrors($validator->errors());
        }
        else
        {
            $newTaxonomy = New Taxonomy();
            $newTaxonomy->name = $request->name;
            $newTaxonomy->slug = $this->clean($request->name);
            $newTaxonomy->input_field_type = $request->input_field_type;
            $newTaxonomy->input_required = $request->input_required;
            $newTaxonomy->order_no = $request->order_no;
            $newTaxonomy->status = $request->status;
            $newTaxonomy->created_by = Auth::user()->id;
         
            if($newTaxonomy -> save())
            {
                return redirect()->route('taxonomy.index')->withSuccess(__($request->name.' Custom Field created successfully.'));
            }
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Taxonomy  $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Taxonomy  $taxonomy)
    {
        $taxonomiesdata = TaxonomyData::where('taxonomy_id', $taxonomy->id)->orderBy('id','DESC')->get();
        return view('backend.inventories.equipments.taxonomies.data.list',  [ 'taxonomy' => $taxonomy, 'taxonomiesdata' => $taxonomiesdata  ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Taxonomy  $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxonomy $taxonomy)
    {
        return view('backend.inventories.equipments.taxonomies.edit', [ 'taxonomy' => $taxonomy ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Taxonomy  $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:taxonomy_data,name',
            'input_field_type' => 'required',
            'input_required' => 'required',
            'order_no' => 'required',
            'status' => 'required',
        ]);

        $taxonomy = Taxonomy::find($id);
        $taxonomy->name = $request->name;
        $taxonomy->slug = $this->clean($request->name);
        $taxonomy->input_field_type = $request->input_field_type;
        $taxonomy->input_required = $request->input_required;
        $taxonomy->order_no = $request->order_no;
        $taxonomy->status = $request->status;
        $taxonomy->updated_by = Auth::user()->id;
   
        if($taxonomy -> save())
        {
            return redirect()->route('taxonomy.index')->with('success', $request->name.' Taxonomy has been updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Taxonomy  $taxonomy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taxonomy = Taxonomy::find($id);
        if($taxonomy -> delete()){
            return back()->with('success', $taxonomy->name.' Taxonomy has been deleted successfully!');
        }
    }

    public function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = strtolower(preg_replace('/-+/', '-', $string));

        return  rtrim($string, '-'); // Replaces multiple hyphens with single one.

     }
}
