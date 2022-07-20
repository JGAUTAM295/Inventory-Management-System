<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $response = array();
        return view('home')->with('response', $response);
    }
    
    /** 

     * Write code on Method

     *

     * @return response()

     */

  

  

    /**

     * Write code on Method

     *

     * @return response()

     */
    public function get_browser_name($user_agent){
    $t = strtolower($user_agent);
    $t = " " . $t;
    if     (strpos($t, 'opera'     ) || strpos($t, 'opr/')     ) return 'Opera'            ;   
    elseif (strpos($t, 'edge'      )                           ) return 'Edge'             ;   
    elseif (strpos($t, 'chrome'    )                           ) return 'Chrome'           ;   
    elseif (strpos($t, 'safari'    )                           ) return 'Safari'           ;   
    elseif (strpos($t, 'firefox'   )                           ) return 'Firefox'          ;   
    elseif (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) return 'Internet Explorer';
    return 'Unkown';
}

     
     public function sendNotification(Request $request)
     {
        $token = "eP39EcR7kxwDdlT7GcVDBX:APA91bEYSjEZ6TzFB-s4fX2R_INh2gM-ErdQUPjq9r2rei-ZJs2w6EOk6oTPlfbq1A5LCepyXCNgxXV6LIg7woNE9XOyHo6YDo5r8aDP0TjJ33WrgI8gCBw5oDU6PrdXMZzpJwZe1k0Y";  
       // $token = "cvEAfRpouEW9Z10KkOODyh:APA91bEGxSTgd9F8FTEXFMAuJMB_pI85Z5J3GtzuQ9YUntvuYJkbLzlVAa14jRGc7FUdkX3HZGQgI0baIHgxx1iA2zTQ9kL_r2O_VNg9ZixTsq7j5YbxskZNISYNANtyBLGjK3XUnaqs";
        $from = "AAAATFUZtsY:APA91bHMmHm4uicdzjW9ffesEkm41shvF2b7Cr5KhqFzFw4MbpyWFs5aRyNtSkQdNAWfTHaS_eiM_eZodrlOfSqn0x9e5j39UDEgvrbeyqoUmPuJYsH8WjmFwk34w9P9pLUfbT61w5nz";
          $browserDetails = $this->get_browser_name($_SERVER['HTTP_USER_AGENT']);
        $msg = array
              (
                'body'  => "Testing Testing ". $browserDetails,
                'title' => "Hi",
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        // dd($result);
         return $result;
        curl_close( $ch );
        
       
    }
    
    

    // public function sendNotification(Request $request)
    // {

    //     $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

    //     $SERVER_API_KEY = 'AAAATFUZtsY:APA91bHMmHm4uicdzjW9ffesEkm41shvF2b7Cr5KhqFzFw4MbpyWFs5aRyNtSkQdNAWfTHaS_eiM_eZodrlOfSqn0x9e5j39UDEgvrbeyqoUmPuJYsH8WjmFwk34w9P9pLUfbT61w5nz';

    //     $data = [

    //         "registration_ids" => $firebaseToken,

    //         "notification" => [

    //             "title" => $request->title,

    //             "body" => $request->body,  

    //         ]

    //     ];

    //     $dataString = json_encode($data);

    

    //     $headers = [

    //         'Authorization: key=' . $SERVER_API_KEY,

    //         'Content-Type: application/json',

    //     ];

    

    //     $ch = curl_init();

      

    //     curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

    //     curl_setopt($ch, CURLOPT_POST, true);

    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    //     $response = curl_exec($ch);

    //      //dd($response);
        
    //     return $response;
    // }
}
