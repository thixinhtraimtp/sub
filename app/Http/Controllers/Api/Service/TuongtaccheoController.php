<?php


namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TuongtaccheoController extends Controller
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
     'order_code_api' => '',
        'social' => '',
    ];
    public function __construct()
    {
            $this->usename = env('USER_TUONGTACCHEO');
        $this->password = env('PASS_TUONGTACCHEO');
    }


    public function createOrder()
    {
        $login = $this->login();
           if ($login =='') {
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
            $mang = explode("\n", $data['comment']);
            
            // Xóa các khoảng trắng và dòng trống
            $mang = array_map('trim', $mang);
            $mang = array_filter($mang);
            
            // Chuyển mảng thành mảng JSON
            $mang_json = json_encode($mang);
            $dataPost = [
         
              'magiamgia' => 'API',
              'id' => $data['object_id'] ?? '',
              'link' => $data['object_id'] ?? '',
              'loai' => 'LIKE',
              'nd' => $mang_json ?? '',
              'tocdolen' => 0,
              'sl' => $data['quantity'] ?? '0',
              'maghinho' => $data['order_code_api'] ?? '',
              'dateTime' => now()->addDays(1)->format('Y-m-d H:i:s'),
                
               
            ];

            $dataPost = http_build_query($dataPost);
            $result = $this->sendRequest($path, $dataPost);
             $lam =json_decode($result,true);
            if(isset($lam['mess']) &&  $lam['mess']== 'Mua thành công'){
                return $data = [
                    'status' => true,
                    'message' => 'Đặt hàng thành công',
                    'data' => $lam['id']
                ];
            }else if($result == 'Mua thành công'){
                 return $data = [
                    'status' => true,
                    'message' => 'Đặt hàng thành công',
                    'data' => $result
                ];
                
            }else{
                return $data = [
                    'status' => false,
                  'message' => isset($lam['mess']) ? $lam['mess'] : 'Đặt đơn thất bại vui lòng liên hệ admin',
                    'data' => $result
                ];
            }
        }
    }
    public function order($id)
    {
        $login = $this->login();
        if ($login == '') {
            return $data = [
                'status' => false,
                'message' => 'Đăng nhập thất bại'
            ];
            die();
        
        }else{
            $path = $this->path;
            $data = $this->data;
            
            $dataPost = [
                'page' => 0,
                'id' =>'',
            
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
            CURLOPT_URL => 'https://tuongtaccheo.com/'. $path . '/themvip.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // set cookie
            CURLOPT_COOKIEJAR => __DIR__ . '/cookiettc.txt',
            CURLOPT_COOKIEFILE => __DIR__ . '/cookiettc.txt',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
             'authority: tuongtaccheo.com',

                'Accept: */*',
 
                'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
                'Origin: https://tuongtaccheo.com',
                'Referer: https://tuongtaccheo.com/tanglike/',
                'Sec-Ch-Ua: "Chromium";v="122", "Not(A:Brand";v="24", "Google Chrome";v="122"',
                'Sec-Ch-Ua-Mobile: ?0',
                'Sec-Ch-Ua-Platform: "Windows"',
                'Sec-Fetch-Dest: empty',
                'Sec-Fetch-Mode: cors',
                'Sec-Fetch-Site: same-origin',
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
                'X-Requested-With: XMLHttpRequest',
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
            CURLOPT_URL => 'https://tuongtaccheo.com/'. $path . '/fetch.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // set cookie
            CURLOPT_COOKIEJAR => __DIR__ . '/cookiettc.txt',
            CURLOPT_COOKIEFILE => __DIR__ . '/cookiettc.txt',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'authority: tuongtaccheo.com',

                'Accept: */*',
 
                'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
                'Origin: https://tuongtaccheo.com',
                'Referer: https://tuongtaccheo.com/tanglike/',
                'Sec-Ch-Ua: "Chromium";v="122", "Not(A:Brand";v="24", "Google Chrome";v="122"',
                'Sec-Ch-Ua-Mobile: ?0',
                'Sec-Ch-Ua-Platform: "Windows"',
                'Sec-Fetch-Dest: empty',
                'Sec-Fetch-Mode: cors',
                'Sec-Fetch-Site: same-origin',
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
                'X-Requested-With: XMLHttpRequest',
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
            CURLOPT_URL => 'https://tuongtaccheo.com/login.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // lưu cookie
            CURLOPT_COOKIEJAR => __DIR__ . '/cookiettc.txt',
            CURLOPT_COOKIEFILE => __DIR__ . '/cookiettc.txt',
            CURLOPT_POSTFIELDS => 'username='.$this->usename.'&password='.$this->password.'&submit=ĐĂNG NHẬP',
            CURLOPT_HTTPHEADER => array(
                'authority: tuongtaccheo.com',
                'accept: application/json, text/javascript, */*; q=0.01',
                'accept-language: vi;q=0.6',
                'content-type: application/x-www-form-urlencoded; charset=UTF-8',
                'origin: https://tuongtaccheo.com',
                'referer: https://tuongtaccheo.com/',
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
}
