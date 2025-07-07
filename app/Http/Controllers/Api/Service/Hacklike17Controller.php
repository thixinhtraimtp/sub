<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Hacklike17Controller extends Controller
{
    public $apiUrl = 'https://hacklike17.com/api/';

    public $apiToken = '';

    public $data = [
        'uid' => '',
        'count' => 0,
        'server' => '',
        'reaction' => 'like',
        'speed' => 0,
        'speed_server_2' => 'default',
        'list_comment' => '',
        'comments' => '',
        'content' => '',
        'type_view' => 0,
        'minutes' => 30,
        // for vip like
        'days' => 0,
    ];

    public function __construct()
    {
        $this->apiToken = env('HACKLIKE17_API_TOKEN');
    }

    public function order($path)
    {
        $url = $this->apiUrl . $path;

        $this->send($this->data, $url);
    }

    public function statusOrder($orderId = '')
    {
        $url = $this->apiUrl . 'faccebook/get-orders';

        $data = [
            'order_id[]' => $orderId,
        ];

        return $this->send($data, $url);
    }

    public function refundOrder($orderId = '')
    {
        $url = $this->apiUrl . 'faccebook/refund';

        $data = [
            'id' => $orderId,
        ];

        return $this->send($data, $url);
    }

    public function warrantyOrder($orderId = '')
    {
        $url = $this->apiUrl . 'faccebook/warranty';

        $data = [
            'id' => $orderId,
        ];

        return $this->send($data, $url);
    }

    public function getPrices()
    {
        $url = $this->apiUrl . 'price';

        return $this->send([], $url);
    }



    public function send($data = [], $url = '')
    {

        $data = array_merge($data, ['token' => $this->apiToken]);
        $data = http_build_query($data);

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
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }
}
