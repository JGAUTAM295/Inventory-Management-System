<?php

namespace App\Http\Controllers;

use App\Models\WebSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Response, Auth, PDF, File;

class WebSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = WebSetting::where('option_title','header')->first();
        
        $header = json_Decode($data->option_value, true);
        
        return view('backend.websetting.index', compact('data', 'header'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!empty($request->id))
        {
            $webSetting = WebSetting::find($request->input('id'));
            
            $data = WebSetting::where('option_title','header')->first();
            
            $header = json_Decode($data->option_value, true);
        }
        else
        {
            $webSetting = New WebSetting();
        }
        
        if($request->hasFile('logoimage')){
            
            $request->validate([
                'logoimage' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            
            if (File::exists($header['logoimage']))
            {
                File::delete($header['logoimage']);
            }

            $file= $request->file('logoimage');
            $imagename = $file->getClientOriginalName();
            $imagename = explode('.', $imagename)[0];
            $filename = $imagename.'_'.time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('websetting'), $filename);
            $logo_image = '/websetting/'.$filename;  
        }
        else
        {
            $logo_image = $header['logoimage'];
        }
        
        if($request->hasFile('faviconimage')){
            
            $request->validate([
                'faviconimage' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
   
            if (File::exists($header['faviconimage'])) 
            {
                File::delete($header['faviconimage']);
            }

            $favicon_file = $request->file('faviconimage');
            $imagename2 = $favicon_file->getClientOriginalName();
            $imagename2 = explode('.', $imagename2)[0];
            $filename2 = $imagename2.'_'.time() . '.' . $favicon_file->getClientOriginalExtension();
            $favicon_file->move(public_path('websetting'), $filename2);
            $favicon_image = '/websetting/'.$filename2;  
        }
        else
        {
            $favicon_image = $header['faviconimage'];
        }
        
        $jsonEquipment = json_encode($request->except('_method', 'id', '_token'));
        $jsonDecode = json_decode($jsonEquipment, true);
        
        $jsonDecode['logoimage'] = $logo_image;
        $jsonDecode['faviconimage'] = $favicon_image;
        
        $jsonEncode = json_encode($jsonDecode);

        
        $webSetting->option_title = 'header';
        $webSetting->option_value = $jsonEncode;
        $webSetting->created_by = Auth::user()->id;
        
        //echo '<pre>'; print_r($jsonEncode); echo '</pre>';
        
        if($webSetting->save())
        {
            return back()->withSuccess(__('Web Settings saved!'));
        }
        else
        {
            return back()->withErrors(__('Web Settings Not saved!'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WebSetting  $webSetting
     * @return \Illuminate\Http\Response
     */
    public function show(WebSetting $webSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WebSetting  $webSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(WebSetting $webSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WebSetting  $webSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebSetting $webSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WebSetting  $webSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebSetting $webSetting)
    {
        //
    }
}
