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
use App\Models\FileLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Response, Auth, PDF, File;

class EquipmentController extends Controller
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
    public function index()
    {
       // $equipments = Equipment::where('inventory_id', $id)->orderBy('id','DESC')->paginate(15);
        //return view('backend.inventories.equipments.list', compact('equipments'))->with('i', ($request->input('page', 1) - 1) * 15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cfs = Taxonomy::where('status', '1')->orderBy('order_no','ASC')->get();
        return view('backend.inventories.equipments.add', compact('id', 'cfs'));
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
            'title'   => 'required|unique:equipment',
            'status' => 'required',
        ]);

        if ($validator->fails())
        {
            $cfs = Taxonomy::where('status', '1')->orderBy('order_no','ASC')->get();
            return view('backend.inventories.equipments.add', compact('id', 'cfs'))->withErrors($validator->errors());
        }
        else
        {
            $jsonEquipment = json_encode($request->except('_token', 'title', 'status'));
            $jsonDecode = json_decode($jsonEquipment, true);
            
            $cf = Taxonomy::where('input_field_type', 'File')->where('status', '1')->orderBy('order_no','ASC')->get();
            
            $colname = $oldfile = array();
        
            $newEquipment = New Equipment();
            $newEquipment->user_id = Auth::user()->id;
            $newEquipment->inventory_id = $id;
            $newEquipment->title = $request->input('title');
            
            foreach($cf as $cf_file) 
            {
                $colname = $cf_file->slug.'='.$cf_file->id;
                
                $allowedMimeTypes = explode(',', $cf_file->file_accept);
                
                if($request->hasFile($colname))
                {
                    $file = $request->file($colname);
                    $imagename = $file->getClientOriginalName();
                    $imagename = explode('.', $imagename)[0];
                    $contentType = $file->getClientOriginalExtension();
                    
                    if (in_array($contentType, $allowedMimeTypes)) 
                    {
                        $filename = $imagename.'_'.time() . '.' . $file->getClientOriginalExtension();
                        
                        if($contentType == 'pdf') 
                        {
                            $coltype = 'doc'; 
                        }
                        
                        if($contentType == 'jpg' || $contentType == 'jpeg' || $contentType == 'png') 
                        {
                            $coltype = 'doc';
                        }
                        
                        $equipmentname  = $coltype."/equipments/".date("Y");
                        $equipmentname2 = $coltype."/equipments/".date("Y")."/".date("m");
                        $equipmentname3 = $coltype."/equipments/".date("Y")."/".date("m")."/".date("d");
                        
                        // if(file_exists($equipmentname))
                        // {
                        //     if(file_exists($equipmentname2)==false)
                        //     {
                        //         if(file_exists($equipmentname3)==false)
                        //         {
                        //             mkdir($equipmentname3, 777, true);
                        //         }
                        //     }
                        // }
                        // else
                        // {
                        //     mkdir($equipmentname, 777, true);
                        //     mkdir($equipmentname2, 777, true);
                        //     mkdir($equipmentname3, 777, true);
                        // }
                        
                        $file->move(public_path($equipmentname3), $filename);
                        $jsonimage = stripslashes($equipmentname3.'/'.$filename);
                        
                        $jsonDecode[$colname] = $jsonimage;
                        $jsonEquipment = json_encode($jsonDecode);
                    }
                    
                }
                
            }
            
            // if($request->hasFile($colname))
            // {
            //     $file = $request->file($colname);
            //     $imagename = $file->getClientOriginalName();
            //     $imagename = explode('.', $imagename)[0];
            //     $contentType = $file->getClientOriginalExtension();
                
            //     if (in_array($contentType, $allowedMimeTypes)) 
            //     {
            //         $filename = $imagename.'_'.time() . '.' . $file->getClientOriginalExtension();
                    
            //         if($contentType == 'pdf') { $coltype = 'doc'; }
                    
            //         if($contentType == 'jpg' || $contentType == 'jpeg' || $contentType == 'png') { $coltype = 'doc'; }
                    
            //         $equipmentname  = $coltype."/equipments/".date("Y");
            //         $equipmentname2 = $coltype."/equipments/".date("Y")."/".date("m");
            //         $equipmentname3 = $coltype."/equipments/".date("Y")."/".date("m")."/".date("d");
                    
            //         // if(file_exists($equipmentname))
            //         // {
            //         //     if(file_exists($equipmentname2)==false)
            //         //     {
            //         //         if(file_exists($equipmentname3)==false)
            //         //         {
            //         //             mkdir($equipmentname3, 777, true);
            //         //         }
            //         //     }
            //         // }
            //         // else
            //         // {
            //         //     mkdir($equipmentname, 777, true);
            //         //     mkdir($equipmentname2, 777, true);
            //         //     mkdir($equipmentname3, 777, true);
            //         // }
                    
            //         $file->move(public_path($equipmentname3), $filename);
            //         $jsonimage = stripslashes($equipmentname3.'/'.$filename);
                    
            //         $jsonDecode[$colname] = $jsonimage;
            //         $jsonEquipment = json_encode($jsonDecode);
            //     }
            // }
            
            $newEquipment->equipment_info = $jsonEquipment;
            $newEquipment->status = $request->status;
            $newEquipment->created_by = Auth::user()->id;

            //echo '<pre>'; print_r($newEquipment); echo '</pre>';

            if($newEquipment->save())
            {
                return redirect()->route('inventory.show', $id)->withSuccess(__('Equipment created successfully!'));
            }
            else
            {
                return redirect()->route('inventory.show', $id)->withErrors(__('Equipment not created successfully!'));
            }
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show($id, $eid)
    {
        $inventory = Inventory::find($id);
        $equipment = Equipment::find($eid);

        return view('backend.inventories.equipments.view', compact('inventory', 'equipment'));
    }

    //Download PDF
    public function downloadPDF($id, $eid)
    {
        $inventory = Inventory::find($id);
        $equipment = Equipment::find($eid);
        $cfs = Taxonomy::where('status', '1')->orderBy('order_no','ASC')->get();
        $qrcode = base64_encode(\QrCode::format('svg')->size(170)->errorCorrection('H')->generate(route('equipment.downloadPDF',['id'=>$inventory->id,'eid'=>$equipment->id])));
        
        $cf = Taxonomy::where('input_field_type', '!=', 'File')->where('status', '1')->orderBy('order_no','ASC')->get();
        
        $fieldcolname = array();
        
        foreach($cf as $cf_list)
        {
          $fieldcolname[] = $cf_list->slug.'='.$cf_list->id;  
        }
        

        view()->share('backend.inventories.equipments.pdf', compact('inventory', 'equipment', 'qrcode', 'cfs', 'fieldcolname'));

        $pdf = PDF::loadView('backend.inventories.equipments.pdf', compact('inventory', 'equipment','qrcode', 'cfs', 'fieldcolname'))->setOptions(['defaultFont' => 'sans-serif']);
        $filename = strtolower(str_replace(' ', '_', $equipment->title)).'_'.rand().'.pdf';
        //return $pdf->download($filename);
        return $pdf->stream($filename);
        
        //return view('backend.inventories.equipments.pdf', compact('inventory', 'equipment','qrcode', 'cfs'));
        
    }

    //getQRCode
    public function getQRCode($id, $eid)
    {
        $inventory = Inventory::find($id);
        $equipment = Equipment::find($eid);
        $xml_version = '<?xml version="1.0" encoding="UTF-8"?>';
    
        return view('backend.inventories.equipments.qr_code', compact('inventory', 'equipment', 'xml_version'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $eid)
    {
        //echo '<pre>'; print_r($id); echo '</pre>';
        $inventory = Inventory::find($id);
        $equipment = Equipment::find($eid);
        $cfs = Taxonomy::where('status', '1')->orderBy('order_no','ASC')->get();
        $jsonEquipment = json_decode($equipment->equipment_info, true); 

        return view('backend.inventories.equipments.edit', compact('cfs', 'inventory', 'equipment', 'jsonEquipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            //'title'   => 'required|unique:equipment',
            'title'   => 'required',
            'status' => 'required',
        ]);
        
        $jsonEquipment = json_encode($request->except('_method', 'id', 'title', '_token', 'status'));
        $jsonDecode = json_decode($jsonEquipment, true);
        
        $cf = Taxonomy::where('input_field_type', 'File')->where('status', '1')->orderBy('order_no','ASC')->get();
        
        $colname = $oldfile = array();
        
        $equipment = Equipment::find($request->route('eid'));
        $equipment->user_id = Auth::user()->id;
        $equipment->inventory_id = $request->route('id');
        $equipment->title = $request->input('title');
        // $equipment->equipment_info = $jsonEquipment;
        $oldjsonDecode = json_decode($equipment->equipment_info, true);
        
        foreach($cf as $cf_file) 
        {
            $colname = $cf_file->slug.'='.$cf_file->id;
            
            if(!empty($oldjsonDecode[$colname]))
            {
              $oldfile = $oldjsonDecode[$colname];  
            }
            
            $allowedMimeTypes = explode(',', $cf_file->file_accept);
            
            if($request->hasFile($colname))
            {
                $file = $request->file($colname);
                $imagename = $file->getClientOriginalName();
                $imagename = explode('.', $imagename)[0];
                $contentType = $file->getClientOriginalExtension();
                
                if (in_array($contentType, $allowedMimeTypes)) 
                {
                    $filename = $imagename.'_'.time() . '.' . $file->getClientOriginalExtension();
                    
                    if($contentType == 'pdf') 
                    {
                        $coltype = 'doc'; 
                    }
                    
                    if($contentType == 'jpg' || $contentType == 'jpeg' || $contentType == 'png') 
                    {
                        $coltype = 'doc';
                    }
                    
                    $equipmentname  = $coltype."/equipments/".date("Y");
                    $equipmentname2 = $coltype."/equipments/".date("Y")."/".date("m");
                    $equipmentname3 = $coltype."/equipments/".date("Y")."/".date("m")."/".date("d");
                    
                    // if(file_exists($equipmentname))
                    // {
                    //     if(file_exists($equipmentname2)==false)
                    //     {
                    //         if(file_exists($equipmentname3)==false)
                    //         {
                    //             mkdir($equipmentname3, 777, true);
                    //         }
                    //     }
                    // }
                    // else
                    // {
                    //     mkdir($equipmentname, 777, true);
                    //     mkdir($equipmentname2, 777, true);
                    //     mkdir($equipmentname3, 777, true);
                    // }
                    
                    if(!empty($oldfile))
                    {
                        if (File::exists('public/'.$oldfile))
                        {
                            File::delete('public/'.$oldfile);
                        }
                        
                    }
                    
                    $file->move(public_path($equipmentname3), $filename);
                    $jsonimage = stripslashes($equipmentname3.'/'.$filename);
                    
                    $jsonDecode[$colname] = $jsonimage;
                    $jsonEquipment = json_encode($jsonDecode);
                    
                }
            }
            else
            {
                $jsonDecode[$colname] = $oldfile;
                $jsonEquipment = json_encode($jsonDecode);
            }
        }
       
        
        // echo '<pre>'; print_r($jsonEquipment); echo '</pre>';

        
        $equipment->equipment_info = $jsonEquipment;
        $equipment->status = $request->status;
        $equipment->updated_by = Auth::user()->id;
   
        if($equipment->save())
        {
            return redirect()->route('inventory.show', $request->route('id'))->withSuccess(__('Equipment has been updated successfully!'));
        }
        else
        {
            return redirect()->route('inventory.show', $request->route('id'))->withErrors(__('Equipment not created successfully!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $eid)
    {
        $equipment = Equipment::find($eid);
        if($equipment -> delete()){
            return back()->with('success', 'Equipment Data has been deleted successfully!');
        }
    }

    //Export CSV
    public function exportcsv($id)
    {
        $inventory = Inventory::find($id);
        $equipments = Equipment::where('inventory_id', $id)->orderBy('id','ASC')->get();
        $fileName = strtolower(str_replace('_', ' ', $inventory->name)).'_equipments'.'_'.time().'_'.rand().'.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $cfs = Taxonomy::where('input_field_type', '!=', 'File')->where('status', '1')->orderBy('order_no','ASC')->get();
        $columns = [];

        $columns[] = strtoupper('title');
        foreach($cfs as $cf)
        {
            $columns[] = strtoupper($cf->name);
        }
        $columns[] = strtoupper('status');
        
        $callback = function() use($equipments, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($equipments as  $equipment) 
            {
                $ccf = Taxonomy::where('input_field_type', 'File')->where('status', '1')->orderBy('order_no','ASC')->get();
                $my_var = json_decode($equipment->equipment_info, true); // convert it to an array.
                
                $json = array();
                
                foreach($ccf as $cf_file) 
                {
                    $colname = $cf_file->slug.'='.$cf_file->id;
                    
                    //$my_var[$colname] = url('/public').'/'.$my_var[$colname];
                    unset($my_var[$colname]);
                    $json = json_encode($my_var);
                    
                }
                
                // $colname = $ccf->slug.'='.$ccf->id;
        
                
                $equipment_info = json_decode($json, true);
                foreach ($equipment_info as  $key => $value) 
                { 
                    if($equipment->status == '1') {
                        $ele_ststus = 'Active';
                    }
                    elseif($equipment->status == '2') {
                        $ele_ststus = 'Deactive';
                    }
                    else
                    {
                        $ele_ststus = 'Deactive';
                    }

                    $equipment_info[$key]  = $value;
                    $equipment_info['status']  = $ele_ststus;
                    
                }
                $equipment_info = array_merge(array('title' => $equipment->title), $equipment_info);
              
                fputcsv($file, $equipment_info);
            }
            
            fclose($file);
        };
        
        //echo '<pre>'; print_r($equipment_info);  echo '</pre>';
         return response()->stream($callback, 200, $headers);
    
        
    }
    //import CSV
    public function importcsv(Request $request, $id)
    {
        
        $inventory = Inventory::find($id);

        if(!empty($inventory)) 
        {
            $data = array();
            //  file validation
            
            $request->validate([
                "csv_file" => "required",
            ]);
            
            $file = $request->file("csv_file");
            $filename = $file->getClientOriginalName();
            $csvData = file_get_contents($file);
            
            $rows = array_map("str_getcsv", explode("\n", $csvData));
            $header = array_shift($rows);
            
            foreach ($rows as $row) 
            {
                if (isset($row[0])) 
                {
                    if ($row[0] != "") 
                    {
                        $row = array_combine($header, $row);
                        
                        // master lead data
                        $EquipmentData = $this->doSnakeCase($row);
                        $keys = array_keys($EquipmentData);

                        //echo '<pre>'; print_r($EquipmentData); echo '</pre>';
                        
                        //echo $keys[0]; // It will echo first key of the array.
                        // echo '<pre>'; print_r(reset($EquipmentData)); echo '</pre>';
                        
                        // ----------- check if lead already exists ----------------
                        
                        $checkEquipment = Equipment::where("user_id", Auth::user()->id)->where("inventory_id", $id)->where("title", "=", reset($EquipmentData))->first();
                        
                        if (!is_null($checkEquipment)) 
                        {
                            if(end($EquipmentData) == 'Active') {
                                $ele_ststus = '1';
                            }
                            elseif(end($EquipmentData) == 'Deactive') {
                                $ele_ststus = '2 ';
                            }
                            else
                            {
                                $ele_ststus = '2';
                            }
                            $EquipmentData['title='] = array_values($EquipmentData['title=']);

                            $equipment = Equipment::find($checkEquipment->id);
                            $equipment->inventory_id = $request->route('id');
                            $equipment->title = ucwords(reset($EquipmentData));
                            $equipment->equipment_info = json_encode($EquipmentData);
                            $equipment->status  = $ele_ststus;
                            $equipment->updated_by = Auth::user()->id;
                            
                            if($equipment->save()) {
                                $data["status"]  = "success";
                                $data["message"] = "Equipment updated successfully!";
                                $data["file_status"] = "2";
                            }
                        }
                        else
                        {
                            if(end($EquipmentData) == 'Active') {
                                $ele_ststus = '1';
                            }
                            elseif(end($EquipmentData) == 'Deactive') {
                                $ele_ststus = '2 ';
                            }
                            else
                            {
                                $ele_ststus = '2';
                            }

                            $newEquipment = New Equipment();
                            $newEquipment->user_id = Auth::user()->id;
                            $newEquipment->inventory_id = $id;
                            $newEquipment->title = ucwords(reset($EquipmentData));
                            $newEquipment->equipment_info = json_encode($EquipmentData);
                            $newEquipment->status =  $ele_ststus;
                            $newEquipment->created_by = Auth::user()->id;
                            
                            if($newEquipment->save()) {
                                $data["status"]  = "success";
                                $data["message"] = "Equipment imported successfully!";
                                $data["file_status"] = "1";
                            }
                        }
                    }
                }
            }
            
            $newFileLog = New FileLog();
            $newFileLog->filename = $filename;
            $newFileLog->status = $data["file_status"];
            $newFileLog->created_by = Auth::user()->id;
             
            if($newFileLog->save()) 
            {
                return back()->with($data["status"], $data["message"]);
            } 
        }
        else
        {
            return back()->with('failed', 'Inventoy not exists!');
        }
        
    }

    private function doSnakeCase(array $array): array
    {
        $result = [];
 
        foreach ($array as $key => $value) 
        {
            $keyExists = $this->keyExistsCase($key, $value);
            $col = $this->getcfID($key);
            // echo '<pre>';
            // print_r($col);
            // echo '</pre>';
            $key = str_replace(' ', '-', $key); // Replaces all spaces with hyphens.
            $key = preg_replace('/[^A-Za-z0-9\-]/', '', $key); // Removes special chars.
            $key = strtolower(preg_replace('/-+/', '-', $key));
    
           $key = rtrim($key, '-'); 
           $key = $key.'='.$col;

            $result[$key] = $value;
        }

        return $result;
    }
    
    private function keyExistsCase($key, $value)
    {
        $result = '';
        $cfslist = Taxonomy::where('name', $key)->where('input_field_type', 'Select')->first();
        
        if(!empty($cfslist))
        {
            $td_query = TaxonomyData::where('taxonomy_id', $cfslist->id)->where('name', $value)->first();

            if(empty($td_query))
            {
                $newTaxonomyData = New TaxonomyData();
                $newTaxonomyData->taxonomy_id = $cfslist->id;
                $newTaxonomyData->name = $value;
                $newTaxonomyData->status = '1';
                $newTaxonomyData->created_by = Auth::user()->id;
                if($newTaxonomyData->save()) 
                {
                    $result = '1';
                }
                else
                {
                    $result = '0';
                } 

            }
            else
            {
                $result = '1';
            }
        }
        
        return $result;
    }

    private function getcfID($ID)
    {
        $cf = Taxonomy::where('name', $ID)->where('status', '1')->first();
        if(!empty($cf))
        {
            return $cf->id;
        }
        
    }

}
