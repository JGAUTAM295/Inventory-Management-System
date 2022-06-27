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
use Illuminate\Support\Str;
use Response;
use Auth;
use PDF;

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
            $newEquipment = New Equipment();
            $newEquipment->user_id = Auth::user()->id;
            $newEquipment->inventory_id = $id;
            $newEquipment->title = $request->input('title');
            $newEquipment->equipment_info = json_encode($request->except('_token', 'title', 'status'));
            $newEquipment->status = $request->status;
            $newEquipment->created_by = Auth::user()->id;
            
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
        $qrcode = base64_encode(\QrCode::format('svg')->size(170)->errorCorrection('H')->generate(route('equipment.downloadPDF',['id'=>$inventory->id,'eid'=>$equipment->id])));

        view()->share('backend.inventories.equipments.pdf', compact('inventory', 'equipment', 'qrcode'));

        $pdf = PDF::loadView('backend.inventories.equipments.pdf', compact('inventory', 'equipment','qrcode'))->setOptions(['defaultFont' => 'sans-serif']);
        $filename = strtolower(str_replace(' ', '_', $equipment->title)).'_'.time().'.pdf';
        //return $pdf->download($filename);
         return $pdf->stream($filename);
        
        //return view('backend.inventories.equipments.pdf', compact('inventory', 'equipment','qrcode'));
        
    }

    //getQRCode
    public function getQRCode($id, $eid)
    {
        $inventory = Inventory::find($id);
        $equipment = Equipment::find($eid);
    
        return view('backend.inventories.equipments.qr_code', compact('inventory', 'equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $eid)
    {
        $inventory = Inventory::find($id);
        $equipment = Equipment::find($eid);
        $cfs = Taxonomy::where('status', '1')->orderBy('order_no','ASC')->get();

        return view('backend.inventories.equipments.edit', compact('cfs', 'inventory', 'equipment'));
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
            'title'   => 'required|unique:equipment',
            'status' => 'required',
        ]);

        $equipment = Equipment::find($request->route('eid'));;
        $equipment->user_id = Auth::user()->id;
        $equipment->inventory_id = $request->route('id');
        $equipment->title = $request->input('title');
        $equipment->equipment_info = json_encode($request->except('_method', 'id', 'title', '_token', 'status'));
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

        $cfs = Taxonomy::where('status', '1')->orderBy('order_no','ASC')->get();
        $columns = [];
       
        foreach($cfs as $cf)
        {
            $columns[] = strtoupper($cf->name);

        }
       
        $callback = function() use($equipments, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
    
                foreach ($equipments as  $equipment) {
                    $equipment_info = json_decode($equipment->equipment_info, true);
                    foreach ($equipment_info as  $key => $value) {
                    $equipment_info[$key]  = $value;
                    }
                    fputcsv($file, $equipment_info);
                }
                
                fclose($file);
        };
       // echo '<pre>'; print_r($equipment_info);  echo '</pre>';
       return response()->stream($callback, 200, $headers);
    
        
    }
    //import CSV
    public function importcsv($id, $eid)
    {
        $inventory = Inventory::find($id);
        $equipment = Equipment::find($eid);
        $qrcode = base64_encode(\QrCode::format('svg')->size(170)->errorCorrection('H')->generate(route('equipment.downloadPDF',['id'=>$inventory->id,'eid'=>$equipment->id])));

        view()->share('backend.inventories.equipments.pdf', compact('inventory', 'equipment', 'qrcode'));

        $pdf = PDF::loadView('backend.inventories.equipments.pdf', compact('inventory', 'equipment','qrcode'))->setOptions(['defaultFont' => 'sans-serif']);
        $filename = strtolower(str_replace(' ', '_', $equipment->title)).'_'.time().'.pdf';
        //return $pdf->download($filename);
         return $pdf->stream($filename);
        
        //return view('backend.inventories.equipments.pdf', compact('inventory', 'equipment','qrcode'));
        
    }
}
