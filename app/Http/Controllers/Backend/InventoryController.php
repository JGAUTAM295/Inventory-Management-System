<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class InventoryController extends Controller
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
        if (Auth::check()) 
        {
            if(Auth::user()->hasRole('admin|Super-Admin'))
            {
                $inventories = Inventory::orderBy('id','DESC')->get();
            }
            if(Auth::user()->hasRole('Staff|Client'))
            {
                $inventories = Inventory::where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();
            }

            return view('backend.inventories.list', compact('inventories'));
        }
        else
        {
            return redirect()->route('dashboard');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.inventories.add');
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
            'name'   => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails())
        {
             return view('backend.inventories.list')->with('status', $validator->errors()->first());
        }
        else
        {
            $newInventory = New Inventory();
            $newInventory->user_id = Auth::user()->id;
            $newInventory->name = $request->name;
            $newInventory->status = $request->status;
            $newInventory->created_by = Auth::user()->id;
         
            if($newInventory -> save())
            {
                return redirect()->route('inventory.index')->withSuccess(__('Inventory created successfully.'));
            }
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = Inventory::find($id);
        $equipments = Equipment::where('inventory_id', $id)->orderBy('id','DESC')->get();
        return view('backend.inventories.equipments.list', compact('inventory','equipments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        return view('backend.inventories.edit', [ 'inventory' => $inventory ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $inventory = Inventory::find($id);
        $inventory->name = $request->name;
        $inventory->status = $request->status;
        $inventory->updated_by = Auth::user()->id;
   
        if($inventory -> save())
        {
            return redirect()->route('inventory.index')->with('success', 'Inventory has been updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        if($inventory -> delete()){
            return back()->with('success', 'Inventory has been deleted successfully!');
        }
    }
}
