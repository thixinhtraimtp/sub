<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TraodoisubController extends Controller
{
    public $usename = '';
    public $password = '';
    public $path = "";
    public $server = "";
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
        'order_codes' =>'',
        'social' => '',
    ];
    public function __construct()
    {
        $this->usename = env('USER_TDS');
        $this->password = env('PASS_TDS');
    }


    public function createOrder()
    {
        $login = $this->login();
        if ($login == false) {
            return $data = [
                'status' => false,
                'message' => 'Đăng nhập thất bại'
            ];
            die();
        }else{
            $path = $this->path;
            $data = $this->data;
            if($data['comment']){
                // cắt comment

            }

            $dataPost = [
                'id' => $data['object_id'] ?? '',
                'sl' => $data['quantity'] ?? '0',
                'is_album' => 'not',
                'dateTime' => now()->addDays(1)->format('Y-m-d H:i:s'),
                'speed' => 1,
                'maghinho'=>$data['order_codes'] ?? 'null',
                'sever' => $data['server_order'] ?? '?',
                'time_pack' => $data['days'] ?? '?',
                'post' => $data['post'] ?? '?',
                'packet' => $data['quantity'] ?? '?',
                'loaicx' => strtoupper($data['reaction']) ?? 'like',
                'noidung' => json_encode(explode("\n", $data['comment'])) ?? '',
                'timeLive' => $data['minutes'] ?? '?',
   
              
            ];

            $dataPost = http_build_query($dataPost);
            $result = $this->sendRequest($path, $dataPost);
        
            $lam = json_decode($result);
            if($result == 'Mua thành công!'){
                return $data = [
                    'status' => true,
                    'message' => 'Đặt hàng thành công',
                    'data' => $result
                ];
            }else{
                return $data = [
                    'status' => false,
                    'message' =>$result,
                    'data' => 'Đã có lỗi xảy ra, liên hệ admin hihihi !'
                ];
            }
        }
    }
    public function order($id)
    {
        $login = $this->login();
        if ($login == false) {
            return $data = [
                'status' => false,
                'message' => 'Đăng nhập thất bại'
            ];
        
        }else{
            $path = $this->path;
            $data = $this->data;
            
            $dataPost = [
                'page' => 1,
                'query' =>'',
            
            ];

            $dataPost = http_build_query($dataPost);
            $result = $this->cul($path, $dataPost);
            return $data = [
                'status' => true,
                'data' => $result
            ];
         
        }
    }
     public function sendRequest($path, $data)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://traodoisub.com/'. $path . '/themid.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // set cookie
            CURLOPT_COOKIEJAR => __DIR__ . '/cookie_tds.txt',
            CURLOPT_COOKIEFILE => __DIR__ . '/cookie_tds.txt',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
              'authority: traodoisub.com',
                'accept: application/json, text/javascript, */*; q=0.01',
                'accept-language: vi;q=0.6',
                'content-type: application/x-www-form-urlencoded; charset=UTF-8',
                
                'origin: https://traodoisub.com',
                'referer: https://traodoisub.com/mua/tiktok_follow3',
                'sec-ch-ua: "Not.A/Brand";v="8", "Chromium";v="114", "Brave";v="114"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "Windows"',
                'sec-fetch-dest: empty',
                'sec-fetch-mode: cors',
                'sec-fetch-site: same-origin',
                'sec-gpc: 1',
                'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
                'x-requested-with: XMLHttpRequest'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function cul($path, $data)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://traodoisub.com/'. $path . '/fetch.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // set cookie
            CURLOPT_COOKIEJAR => __DIR__ . '/cookie_tds.txt',
            CURLOPT_COOKIEFILE => __DIR__ . '/cookie_tds.txt',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'authority: traodoisub.com',
                'accept: */*',
                'accept-language: vi;q=0.6',
                'content-type: application/x-www-form-urlencoded; charset=UTF-8',
                'origin: https://traodoisub.com',
                'referer: https://traodoisub.com/mua/likevip/',
                'sec-ch-ua: "Not.A/Brand";v="8", "Chromium";v="114", "Brave";v="114"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "Windows"',
                'sec-fetch-dest: empty',
                'sec-fetch-mode: cors',
                'sec-fetch-site: same-origin',
                'sec-gpc: 1',
                'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
                'x-requested-with: XMLHttpRequest'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
    public function login()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://traodoisub.com/scr/login.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // lưu cookie
            CURLOPT_COOKIEJAR => __DIR__ . '/cookie_tds.txt',
            CURLOPT_COOKIEFILE => __DIR__ . '/cookie_tds.txt',
            CURLOPT_POSTFIELDS => 'username=' . $this->usename . '&password=' . $this->password,
            CURLOPT_HTTPHEADER => array(
                'authority: traodoisub.com',
                'accept: application/json, text/javascript, */*; q=0.01',
                'accept-language: vi;q=0.6',
                'content-type: application/x-www-form-urlencoded; charset=UTF-8',
                'origin: https://traodoisub.com',
                'referer: https://traodoisub.com/',
                'sec-ch-ua: "Not.A/Brand";v="8", "Chromium";v="114", "Brave";v="114"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "Windows"',
                'sec-fetch-dest: empty',
                'sec-fetch-mode: cors',
                'sec-fetch-site: same-origin',
                'sec-gpc: 1',
                'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
                'x-requested-with: XMLHttpRequest'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
     
        if (empty($response)) {
            return false;
        } else {
            
            if ($response != '1') {
                return true;
            } else {
                return false;
            }
        }
    }
}
