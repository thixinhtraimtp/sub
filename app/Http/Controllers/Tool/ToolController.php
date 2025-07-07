<?php

namespace App\Http\Controllers\Tool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Order;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class ToolController extends Controller
{
    
    public function getServices(Request $request)
    {
        try {
            // Lấy tham số 'domain' từ yêu cầu GET
            $domain = $request->query('domain');
            $key = $request->query('key');

            if (!$domain) {
                return response()->json([
                    'error' => 'Vui lòng điền đầy đủ thông tin',
                ], 400);
            }

            $data = [
                'key' => $key,
                'action' => 'services',
            ];

            $response = Http::post($domain, $data);
            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                return response()->json([
                    'success' => false,
                    'status' => $response->status(),
                    'message' => $response->body(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function getOrder(Request $request)
    {
        if (getDomain() == env('APP_MAIN_SITE')) {
            $orders = Order::where('status', '!=', 'Completed')->where('status', '!=', 'Cancelled')->where('status', '!=', 'Refunded')->where('status', '!=', 'Failed')->where('status', '!=', 'Partial')->where('status', '!=', 'Success')->where('status', '!=', 'PendingRefundPartial')->where('status', '!=', 'PendingRefundCancel')->where('status', '!=', 'Partially Refunded')->where('status', '!=', 'Partially Completed')->orderBy('id', 'desc')->limit(100)->get();

            $responseData = [];

            foreach ($orders as $order) {
                if ($order->orderProviderName == 'dontay') {
                    $responseData[] = [
                        'id' => $order->id,
                        'user_id' => $order->user_id,
                        'service_id' => $order->service_id,
                        'server_id' => $order->server_id,
                        'orderProviderName' => $order->orderProviderName,
                        'orderProviderServer' => $order->orderProviderServer,
                        'orderProviderPath' => $order->orderProviderPath,
                        'order_package' => $order->order_package,
                        'object_server' => $order->object_server,
                        'object_id' => $order->object_id,
                        'order_id' => $order->order_id,
                        'order_code' => $order->order_code,
                        //'order_data' => $order->order_data,
                        'start' => $order->start,
                        'buff' => $order->buff,
                        'duration' => $order->duration,
                        'remaining' => $order->remaining,
                        'posts' => $order->posts,
                        'price' => $order->price,
                        'payment' => $order->payment,
                        'status' => $order->status,
                        'ip' => $order->ip,
                        'note' => $order->note,
                        'error' => $order->error,
                        'time' => $order->time,
                        'created_at' => $order->created_at,
                        'updated_at' => $order->updated_at,
                        'domain' => $order->domain,
                        'voucher' => $order->voucher,
                    ];
                }
            }

            return response()->json([
                'code' => 200,
                'message' => 'Lấy lịch sử đơn hàng thành công',
                'status' => 'SUCCESS',
                'data' => $responseData,
            ]);
            
        }
    }


    public function getUid(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'link' => 'required|url'
        ]);

        if ($valid->fails()) {
            return response()->json([
                'status' => false,
                'message' => $valid->errors()->first()
            ]);
        } else {
            /* api */
            $link = $request->link;

            function getUID($link)
            {
                $client = new Client();
                $headers = [
                    'accept' => 'application/json, text/javascript, */*; q=0.01',
                    'accept-language' => 'vi,en;q=0.9,en-GB;q=0.8,en-US;q=0.7',
                    'content-type' => 'application/x-www-form-urlencoded; charset=UTF-8',
                    'cookie' => 'cf_clearance=MC8xALVVWfK6OH0Q5LFm8b2rYuP7CiFCxsspPSY6oFM-1710181141-1.0.1.1-_wOS3gr_Wj3Ctr_ArQzOtx8NGko1hD3RQI3I99NDKL6Q564AL6K1bTMrgpbgXe6pPKKJc0sqZH4IxQCQsjd5gA',
                    'origin' => 'https://id.traodoisub.com',
                    'priority' => 'u=1, i',
                    'referer' => 'https://id.traodoisub.com/',
                    'sec-ch-ua' => '"Chromium";v="124", "Microsoft Edge";v="124", "Not-A.Brand";v="99"',
                    'sec-ch-ua-mobile' => '?0',
                    'sec-ch-ua-platform' => '"Windows"',
                    'sec-fetch-dest' => 'empty',
                    'sec-fetch-mode' => 'cors',
                    'sec-fetch-site' => 'same-origin',
                    'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0',
                    'x-requested-with' => 'XMLHttpRequest'
                ];
                $body = 'link=' . $link;
                $request = new Psr7Request('POST', 'https://id.traodoisub.com/api.php', $headers, $body);
                $res = $client->sendAsync($request)->wait();
                $data = json_decode($res->getBody());
                if (isset($data) && $data->success == 200) {
                    return $data->id;
                } else {
                    return false;
                }
            }

            $uid = getUID($link);
            if (!$uid) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Không thể lấy UID'
                ]);
            }

            try {

                $api_url = "https://buithaihien.com/hienthaibui.php?id=$uid&key=BuiThaiHien";
                $client = new Client();
                $response = $client->request('GET', $api_url);
                $body = $response->getBody();
                $data = json_decode($body);
                if (isset($data) && $data->status == 'success') {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Lấy UID thành công',
                        'data' => [
                            'id' => $data->result->id,
                            'name' => $data->result->name,
                            'username' => $data->result->username,
                            'followers' => $data->result->followers,
                        ]
                    ]);
                } else {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Lấy UID thành công',
                        'data' => [
                            'id' => $uid,
                            'name' => 'Không xác định',
                            'username' => 'Không xác định',
                            'followers' => 'Không xác định',
                        ]
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Lấy UID thành công',
                    'data' => [
                        'id' => $uid,
                        'name' => 'Không xác định',
                        'username' => 'Không xác định',
                        'followers' => 'Không xác định',
                    ]
                ]);
            }
        }
    }
}
