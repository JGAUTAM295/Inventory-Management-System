<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Equipment;
use App\Models\Taxonomy;
use App\Models\TaxonomyData;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class DepartmentController extends Controller
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
        $role = Role::findOrFail(Auth::user()->roles->first()->id);
        $groupsWithRoles = $role->getPermissionNames()->toArray();
        
        $departments = Department::orderBy('id','DESC')->get();
        
        return view('backend.department.list', compact('departments', 'groupsWithRoles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.department.add');
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
            'name' => 'required|unique:departments,name',
            'department_no' => 'required|unique:departments,department_no',
            'colorbg' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails())
        {
             return view('backend.department.add')->withErrors($validator->errors());
        }
        else
        {
            $newDepartment = New Department();
            $newDepartment->name = $request->name;
            $newDepartment->department_no = $request->department_no;
            $newDepartment->colorbg = $request->colorbg;
            $newDepartment->status = $request->status;
            $newDepartment->created_by = Auth::user()->id;
         
            if($newDepartment -> save())
            {
                return redirect()->route('departments.index')->withSuccess(__($request->name.' Department created successfully!'));
            }
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Department $department)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('backend.department.edit', [ 'department' => $department ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'department_no' => 'required',
            'colorbg' => 'required',
            'status' => 'required',
        ]);

        $department = Department::find($id);
        $department->name = $request->name;
        $department->department_no = $request->department_no;
        $department->colorbg = $request->colorbg;
        $department->status = $request->status;
        $department->updated_by = Auth::user()->id;
   
        if($department->save())
        {
            return redirect()->route('departments.index')->with('success', $request->name.' Department has been updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        if($department->delete()){
            return back()->with('success', $department->name.' Department has been deleted successfully!');
        }
    }
}
