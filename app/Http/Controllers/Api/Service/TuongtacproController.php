<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TuongtacproController extends Controller
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
        'code_order_api' => '',
        'social' => '',
    ];

    public function __construct()
    {
        $this->apiToken = env('TUONGTACPRO_API_TOKEN');
    }

    public function CreateOrder()
    {
        $url = 'https://api.tuongtac.pro/api/orders';
        $data = $this->data;
        
         
        $dataPost = [
            'link' => $data['object_id'],
            'quantity' => $data['quantity'],
            'customer_service_id' => $data['server_order'],
            'reaction' => $data['reaction'],
            'detail' =>  $data['code_order_api']
           
        ];
        $response = $this->sendRequest($url, $dataPost);
        if (isset($response['message']) &&  $response['message'] == 'Tạo đơn thành công') {
            return $data = [
                'status' => true,
                'message' => 'Đặt hàng thành công',
                'data' => $response['message']
            ];
        } else {
            return $data = [
                'status' => false,
                'message' => $response['message'] ?? 'Bé iu chờ xíu nhé !!'
            ];
        }
    }
 
    public function order($id)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.tuongtac.pro/api/ordersget-by-id?ids=' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->apiToken,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        if ($response['status'] == 200) {
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

    public function sendRequest($url, $data = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->apiToken,
                'Content-Type: application/json'

            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }
}
