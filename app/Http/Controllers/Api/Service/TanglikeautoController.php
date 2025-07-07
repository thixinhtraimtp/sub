<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TanglikeautoController extends Controller
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
        $this->api_token = env('TANGLIKE_API_TOKEN');
    }

    public function CreateOrder()
    {
        $url = "https://tanglikeauto.vn/api/service/";
        $headers[] = 'Api-Token: ' . $this->api_token;
     
        $headers[] = 'Content-Type: application/json';
        
        $uri = $url . $this->path . '/order';
        $data = $this->data;
        $dataPost = [
            'link_order' => $data['object_id'] ?? '',
            'server_service' => $data['server_order'] ?? 'null',
            'reaction' => $data['reaction'] ?? 'like',
            'quantity' => $data['quantity'] ?? '0',
            'speed' => $data['speed'] == '1' ? 'fast' : 'slow',
            'comment' => $data['comment'] ?? '',
            'minutes' => $data['minutes'] ?? '0',
            'time' => $data['time'] ?? '0',
            'days' => $data['days'] ?? '0',
            'post' => $data['post'] ?? '0',
        ];

        $result = $this->curl($uri, $headers, $dataPost);
        return $result;
    }
 
    public function order($order_code)
    {
        $url = "https://tanglikeauto.vn/api/get/orders";
        $headers[] = 'Api-Token: ' . $this->api_token;
     
        $headers[] = 'Content-Type: application/json';
        
       
        $data = [
            'order_id' => $order_code,
        ];
        $result = $this->curl($url, $headers, $data);
        return $result;
    }

    public function curl($path, $token, $data = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $token);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        curl_close($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $res = [];
        return json_decode($result, true);
    }

    public function curlOrder($path, $token, $data = [], $method = 'POST')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $token);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        curl_close($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $res = [];
        return json_decode($result, true);
    }
}
