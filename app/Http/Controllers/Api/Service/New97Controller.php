<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class New97Controller extends Controller
{
    private $api_token;
    public $path = "";
    public $data = [
        'object_id' => '',
        'quantity' => '',
        'speed' => '',
        'comment' => '',
        'minutes' => '',
        'time' => '',
        'days' => '',
        'post' => '',
        'reaction' => '',
        'server_order' => '',
        'social' => '',
    ];

    public function __construct()
    {
        $this->api_token = env('NEW97_API_TOKEN');
    }

    public function CreateOrder()
    {
      
        $data = $this->data;
        
        
        $data = array(
            "link" => $data['object_id'] ?? '',
            "quantity" =>  $data['quantity'] ?? '0',
            "minutes" => $data['minutes'] ?? '0',
            "gif" => "",
            "note" => "",
            "channel" => $data['server_order'] ?? 'null',
        );
   
        $result = $this->curl($data);
        return $result;
    }

     
    public function order($order_code)
    {
        
        
        
        $data = array(
            "id" => $order_code
            
        );
   
        $result = $this->curl($data);
        return $result;
    }

    public function curl($data)
    {

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://new97.net/new_2024/public/api/v1.php',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>json_encode($data),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: '.$this->api_token,
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
          
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return json_decode($response, true);
    }
}
