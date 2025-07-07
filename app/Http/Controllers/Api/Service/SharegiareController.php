<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SharegiareController extends Controller
{
    private $apiToken;
    public $path = "";
    public $server = "";
    public $data = [
        'object_id' => '',
        'quantity' => '',
        'speed' => '',
        'comment' => '',
        'minutes' => '',
        'time' => '',
        'duration' => '',
        'post' => '',
        'reaction' => '',
        'server_order' => '',
        'social' => '',
    ];

    public function __construct()
    {
        $this->apiToken = env('SHAREGIARE_API_TOKEN');
    }

    public function CreateOrder()
    {
       
        $data = $this->data;
        $datapost = array(
        'token' => $this->apiToken,
        'link' => $data['object_id'],
        'server_service' => $data['server_order'],
        'quantity' =>  $data['quantity']
        );
         
      
        $response = $this->sendRequest($datapost);
        if ($response['status'] == 'success') {
            return $data = [
                'status' => true,
                'message' => 'Đặt hàng thành công',
                'data' => $response['order']
            ];
        } else {
            return $data = [
                'status' => false,
                'message' => $response['message']
            ];
        }
    }
 
    public function order($id)
    {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sharegiare.xyz/api/list_order',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('token' => $this->apiToken,'type' => 'share-profile'),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $response = json_decode($response, true);
        if ($response['status'] == 'success') {
            return $data = [
                'status' => true,
                'message' => 'Cập nhật thành công',
                'data' => $response['data']
            ];
        } else {
            return $data = [
                'status' => 'error',
                'message' => $response['message'],
            ];
        }
    }

    public function sendRequest($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sharegiare.xyz/api/order',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $data,
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return json_decode($response, true);
    }
}
