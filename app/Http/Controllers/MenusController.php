<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use App\Models\MenuItem;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menus::orderBy('menu_order', 'ASC')->get();
        
        $role = Role::findOrFail(Auth::user()->roles->first()->id);
        $groupsWithRoles = $role->getPermissionNames()->toArray();

        return view('backend.menus.list', [ 'menus' => $menus, 'groupsWithRoles' => $groupsWithRoles ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $menu_items = MenuItem::orderBy('id', 'ASC')->get();
       $roles = Role::pluck('name','name')->all();
       
       return view('backend.menus.add', compact('menu_items', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'parentmenu' => 'required',
            'menu_order' => 'required'
        ]);
        
        $menus = New Menus();
        $menus->user_role = implode(',', $request->roles);
        $menus->menu_item = $request->name;
        $menus->faicon = $request->faicon;
        $menus->url = $request->url;
        $menus->child_menu = $request->parentmenu;
        
        if($request->parentmenu == 'Yes')
        {
           $menus->parent_menu = implode(',', $request->parent_id);
        }
        
        $menus->menu_order = $request->menu_order;
        $menus->status = $request->status;
        $menus->created_by =  Auth::user()->id;

        $menus->save();

        return redirect()->route('menus.index')->with('success','Menu Item created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function show(Menus $menus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menus = Menus::find($id);
        $menu_items = MenuItem::orderBy('id', 'ASC')->get();
        $roles = Role::pluck('name','name')->all();
        $selected_role = explode(",", $menus->user_role);
        $selected_menu = explode(",", $menus->parent_menu);
       
       return view('backend.menus.edit', compact('menus', 'menu_items', 'roles', 'selected_role', 'selected_menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'parentmenu' => 'required',
            'menu_order' => 'required'
        ]);
        
        $menus = Menus::find($id);
        $menus->user_role = implode(',', $request->roles);
        $menus->menu_item = $request->name;
        $menus->faicon = $request->faicon;
        $menus->url = $request->url;
        $menus->child_menu = $request->parentmenu;
        
        if($request->parentmenu == 'Yes')
        {
           $menus->parent_menu = implode(',', $request->parent_id);
        }
        
        $menus->menu_order = $request->menu_order;
        $menus->status = $request->status;
        $menus->updated_by =  Auth::user()->id;

        $menus->save();

        return redirect()->route('menus.index')->with('success','Menu Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menus = Menus::find($id);
        if($menus->delete()){
            return back()->with('success', $menus->name.' Menu has been deleted successfully!');
        }
    }
    
    
    // Menu Item/Links Functions
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function link_index()
    {
        $menus = MenuItem::orderBy('id', 'ASC')->get();
        
        $role = Role::findOrFail(Auth::user()->roles->first()->id);
        $groupsWithRoles = $role->getPermissionNames()->toArray();

        return view('backend.menus.menu_item.list', [ 'menus' => $menus, 'groupsWithRoles' => $groupsWithRoles ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function link_create(Request $request)
    {
        return view('backend.menus.menu_item.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function link_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'menu_order' => 'required'
        ]);
        
        $menus = New MenuItem();
        $menus->name = $request->name;
        $menus->url = $request->url;
        $menus->menu_order = $request->menu_order;
        $menus->created_by =  Auth::user()->id;

        $menus->save();

        return redirect()->route('menus_item.index')->with('success', 'Menu Item created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function link_show(Menus $menus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function link_edit($id)
    {
        $menu_item = MenuItem::find($id);
        
        return view('backend.menus.menu_item.edit', compact('menu_item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function link_update(Request $request, $id)
    {
        
        $menus = MenuItem::find($id);
        $menus->name = $request->name;
        $menus->url = $request->url;
        $menus->menu_order = $request->menu_order;
        $menus->updated_by =  Auth::user()->id;

        $menus->save();

        return redirect()->route('menus_item.index')->with('success', 'Menu Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function link_destroy($id)
    {
        $menus = MenuItem::find($id);
        if($menus->delete()){
            return back()->with('success', $menus->name.' Menu Item has been deleted successfully!');
        }
    }
}
