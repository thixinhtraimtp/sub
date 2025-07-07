<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Api\Service\BaostarController;
use App\Http\Controllers\Api\Service\BoosterviewsController;
use App\Http\Controllers\Api\Service\CheoTuongTacController;
use App\Http\Controllers\Api\Service\CongLikeController;
use App\Http\Controllers\Api\Service\TuongtaccheoController;
use App\Http\Controllers\Api\Service\Hacklike17Controller; 
use App\Http\Controllers\Api\Service\SmmKingController;
use App\Http\Controllers\Api\Service\SharegiareController;
use App\Http\Controllers\Api\Service\New97Controller;
use App\Http\Controllers\Api\Service\SubgiareController;
use App\Http\Controllers\Api\Service\TraodoisubController;
use App\Http\Controllers\Api\Service\TuongTacSaleController;
use App\Http\Controllers\Api\Service\TuongtacproController;
use App\Http\Controllers\Api\Service\TwoMxhController;
use App\Http\Controllers\Api\Service\TanglikeautoController;

use App\Http\Controllers\Controller;
use App\Library\TelegramSdk;
use App\Models\Order;
use App\Models\Smm;
use App\Models\Voucher;
use App\Models\PartnerWebsite;
use App\Models\ServerAction;
use App\Models\Service;
use App\Models\ServiceServer;
use App\Models\ServicePlatform;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function createOrder(Request $request)
    {
        try {

            if (site('maintain') === 'on') {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'Hệ thống đang bảo trì, vui lòng quay lại sau !',
                ], 401);
            }
            $api_token = $request->header('X-Access-Token');

            if (!$api_token) {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'Không tìm thấy X-Access-Token !',
                ], 401);
            }

            $domain = $request->getHost();
            $user = User::where('api_token', $api_token)->where('domain', $domain)->first();

            if (!$user) {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'X-Access-Token không hợp lệ !',
                ], 401);
            }

            if ($user->status !== 'active') {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'Tài khoản của bạn hiện tại không được phép thực hiện hành động này !',
                ], 401);
            }

            $valid = Validator::make($request->all(), [
                'provider_package' => 'required',
                'provider_server' => 'required',
            ], [
                'provider_package.required' => 'Không tìm thấy gói cần mua !',
                'provider_server.required' => 'Vui lòng chọn server cần mua !',
            ]);

            if ($valid->fails()) {
                return response()->json([
                    'code' => '400',
                    'status' => 'error',
                    'message' => $valid->errors()->first(),
                ], 400);
            }





            if ($domain === env('APP_MAIN_SITE')) {

                $service = Service::where('package', $request->provider_package)->where('domain', env('APP_MAIN_SITE'))->first();

                if (!$service) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Gói cần mua không tồn tại !',
                    ], 400);
                }

                if ($service->status !== 'active') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Gói cần mua hiện không khả dụng !',
                    ], 400);
                }
                $service_platform = ServicePlatform::where('id', $service->platform_id)->first();
                $provider_servers = str_replace('sv-', '', $request->provider_server);


                $lam12 = explode("_", $provider_servers);
                $provider_server = $lam12[0];
                $server = ServiceServer::where('service_id', $service->id)->where('package_id', $provider_server)->where('domain', $domain)->first();

                if (!$server) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Máy chủ này không tồn tại !',
                    ], 400);
                }

                if ($server->visibility !== 'public') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Máy chủ này không khả dụng !',
                    ], 400);
                }

                if ($server->status !== 'active') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Máy chủ này hiện đang bảo trì !',
                    ], 400);
                }

                $validService = Validator::make($request->all(), [
                    'object_id' => 'required',
                ], [
                    'object_id.required' => 'Vui lòng nhập UID hoặc Link cần mua !',
                ]);

                if ($validService->fails()) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => $validService->errors()->first(),
                    ], 400);
                }

                $serverAction = ServerAction::where('server_id', $server->id)->first();

                if (!$serverAction) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Máy chủ này hiện đang bị lỗi vui lòng thử lại sau !',
                    ], 400);
                }

                if ($serverAction->quantity_status === 'on') {
                    $valid = Validator::make($request->all(), [
                        'quantity' => 'required|integer'
                    ], [
                        'quantity.required' => 'Vui lòng chọn số lượng cần mua !',
                        'quantity.integer' => 'Số lượng cần mua phải là số !',
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $valid->errors()->first(),
                        ], 400);
                    }
                }

                if ($serverAction->reaction_status === 'on') {
                    $valid = Validator::make($request->all(), [
                        'reaction' => 'required'
                    ], [
                        'reaction.required' => 'Vui lòng cảm xúc !',
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $valid->errors()->first(),
                        ], 400);
                    }
                }

                if ($serverAction->comments_status === 'on') {
                    $valid = Validator::make($request->all(), [
                        'comments' => 'required'
                    ], [
                        'comments.required' => 'Vui lòng nhập nội dung bình luận !',
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $valid->errors()->first(),
                        ], 400);
                    }

                    $count = 0;
                    $comments = explode("\n", $request->comments);
                    $comments = array_filter($comments, 'trim');
                    $comments = array_values($comments);
                    $count = count($comments);
                    $request->merge(['quantity' => $count]);
                }

                if ($serverAction->minutes_status === 'on') {
                    $valid = Validator::make($request->all(), [
                        'minutes' => 'required|integer'
                    ], [
                        'minutes.required' => 'Vui lòng chọn Số Phút cần mua !',
                        'minutes.integer' => 'Số Phút cần mua phải là số !',
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $valid->errors()->first(),
                        ], 400);
                    }
                }

                if ($serverAction->posts_status === 'on') {
                    $valid = Validator::make($request->all(), [
                        'posts' => 'required'
                    ], [
                        'posts.required' => 'Vui lòng chọn số bài viết cần mua !',
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $valid->errors()->first(),
                        ], 400);
                    }

                    $newPost = $request->posts == 'unlimited' ? 1 : $request->posts;
                    $request->merge(['posts' => $newPost]);
                }

                if ($serverAction->time_status === 'on') {
                    $valid = Validator::make($request->all(), [
                        'duration' => 'required|integer'
                    ], [
                        'duration.required' => 'Vui lòng chọn số bài viết cần mua !',
                        'duration.integer' => 'Số bài viết cần mua phải là số !',
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $valid->errors()->first(),
                        ], 400);
                    }
                }

                if ($server->limit_day > 0) {
                    $orderToday = Order::where('server_id', $server->id)->whereDate('created_at', Carbon::today())->count();

                    if ($orderToday >= $server->limit_day) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => 'Máy chủ này đã đạt giới hạn mua hàng trong ngày !',
                        ], 400);
                    }
                }

                if ($request->quantity < $server->min) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Số lượng cần mua phải lớn hơn hoặc bằng ' . $server->min . ' !',
                    ], 400);
                }

                if ($request->quantity > $server->max) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Số lượng cần mua phải nhỏ hơn hoặc bằng ' . $server->max . ' !',
                    ], 400);
                }
                $price = $server->levelPrice($user->level);
                if (isset($request->voucher) && $request->voucher !== '') {
                    $voucher = Voucher::where('name', $request->voucher)->where('domain', getDomain())->first();
                    if ($voucher) {


                        $start = Carbon::parse($voucher->timeStart);
                        $end = Carbon::parse($voucher->timeEnd);
                        $nows = Carbon::now();
                        $now = Carbon::parse($nows);
                        if (!($now->between($start, $end, true) || $now->isSameDay($end))) {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'message' => 'Mã giảm giá đã hết hạn sử dụng!',
                            ], 400);
                        }

                        if ($voucher->limitUser !== '0') {
                            $orderVoucher = Order::where('voucher', $request->voucher)->where('domain', getDomain())->count();
                            if ($orderVoucher >= $voucher->limitUser) {
                                return response()->json([
                                    'code' => '400',
                                    'status' => 'error',
                                    'message' => 'Mã giảm giá đã hết luợt sử dụng !',
                                ], 400);
                            }
                        }
                        if ($voucher->user_voucher !== '0') {
                            $string = $voucher->user_voucher;


                            $search = $user->username;

                            $parts = array_map('trim', explode('|', $string));
                            if (!in_array($search, $parts)) {
                                return response()->json([
                                    'code' => '400',
                                    'status' => 'error',
                                    'message' => 'Bạn không nằm trong danh sách may mắn được sử dụng voucher này !',
                                ], 400);
                            }
                        }



                        if ($serverAction->time_status === 'on') {
                            $totals = $price * $request->quantity * $request->duration;
                            $total = $totals - ($totals * $voucher->percent / 100);
                        } elseif ($serverAction->posts_status === 'on') {
                            $posts = $request->posts == 'unlimited' ? 1 : $request->posts;
                            $totals = $price * $request->quantity * $posts;
                            $total = $totals - ($totals * $voucher->percent / 100);
                        } elseif ($serverAction->minutes_status === 'on') {

                            $totals = $price * $request->quantity * $request->minutes;
                            $total = $totals - ($totals * $voucher->percent / 100);
                        } elseif ($serverAction->minutes_status === 'on' && $serverAction->time_status === 'on') {

                            $totals = $price * $request->quantity * $request->minutes * $request->duration;
                            $total = $totals - ($totals * $voucher->percent / 100);
                        } elseif ($serverAction->time_status === 'on' && $serverAction->posts_status === 'on') {
                            $posts = $request->posts == 'unlimited' ? 1 : $request->posts;
                            $totals = $price * $request->quantity * $request->duration * $posts;
                            $total = $totals - ($totals * $voucher->percent / 100);
                        } else {
                            $totals = $price * $request->quantity;
                            $total = $totals - ($totals * $voucher->percent / 100);
                        }
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => 'Mã voucher giảm giá không hợp lệ !',
                        ], 400);
                    }
                } else {
                    if ($serverAction->time_status === 'on') {
                        $total = $price * $request->quantity * $request->duration;
                    } elseif ($serverAction->posts_status === 'on') {
                        $posts = $request->posts == 'unlimited' ? 1 : $request->posts;
                        $total = $price * $request->quantity * $posts;
                    } elseif ($serverAction->minutes_status === 'on') {

                        $total = $price * $request->quantity * $request->minutes;
                    } elseif ($serverAction->minutes_status === 'on' && $serverAction->time_status === 'on') {

                        $total = $price * $request->quantity * $request->minutes * $request->duration;
                    } elseif ($serverAction->time_status === 'on' && $serverAction->posts_status === 'on') {
                        $posts = $request->posts == 'unlimited' ? 1 : $request->posts;
                        $total = $price * $request->quantity * $request->duration * $posts;
                    } else {
                        $total = $price * $request->quantity;
                    }
                }

                if ($user->balance < ceil($total)) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Số dư của bạn không đủ để thực hiện giao dịch này !',
                    ], 400);
                }

                $orderID = null;
                $orderCode = site('madon') . '_' . time() . rand(1000, 9999);
                if (isset($server->percents)) {
                    $quantity = $request->quantity * ($server->percents / 100);
                } else {
                    $quantity = $request->quantity;
                }
                if ($server->providerName == 'trumsubre' || $server->providerName == 'subgiare') {
                    $sgr = new SubgiareController();
                    $sgr->path = $server->providerLink;
                    $sgr->data = [
                        'object_id' => $request->object_id,
                        'server_order' => $server->providerServer,
                        'quantity' => $quantity,
                        'reaction' => $request->reaction,
                        'speed' => 'fast',
                        'comment' => $request->comments,
                        'minutes' => $request->minutes,
                        'time' => $request->time,
                        'days' => $request->duration,
                        'post' => $request->posts,
                    ];

                    $result = $sgr->createOrder();
                    if (isset($result) && $result['status'] === true) {
                        $orderID = $result['data']['code_order'];
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => 'Máy chủ hết tài nguyên, vui lòng liên hệ admin để được hỗ trợ !',
                        ], 400);
                    }
                } else if ($server->providerName == 'new97' || $server->providerName == 'https://new97.net/api/v2/') {
                    $snew = new SubgiareController();

                    $snew->data = [
                        'object_id' => $request->object_id,
                        'server_order' => $server->providerServer,
                        'quantity' => $quantity,
                        'reaction' => $request->reaction,
                        'speed' => 'fast',
                        'comment' => $request->comments,
                        'minutes' => $request->minutes,
                        'time' => $request->time,
                        'days' => $request->duration,
                        'post' => $request->posts,
                    ];

                    $result = $snew->createOrder();
                    if (isset($result['status']) && $result['status'] === 'success') {
                        $orderID = $result['id'];
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['msg'],
                        ], 400);
                    }
                } else if ($server->providerName == 'tanglikeauto') {
                    $tanglike = new TanglikeautoController();
                    $tanglike->path = $server->providerLink;
                    $tanglike->data = [
                        'object_id' => $request->object_id,
                        'server_order' => $server->providerServer,
                        'quantity' => $quantity,
                        'reaction' => $request->reaction,
                        'speed' => 'fast',
                        'comment' => $request->comments,
                        'minutes' => $request->minutes,
                        'time' => $request->time,
                        'days' => $request->duration,
                        'post' => $request->posts,
                    ];

                    $result = $tanglike->createOrder();

                    if (isset($result['status']) && $result['status'] === 'success') {
                        $orderID = $result['order_id'];
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => 'Vui lòng liên hệ admin',
                        ], 400);
                    }
                } else if ($server->providerName == 'traodoisub') {
                    $orderCode = time() . rand(1000, 9999);
                    $tds = new TraodoisubController();
                    $tds->path = $server->providerLink;
                    $tds->data = [
                        'object_id' => $request->object_id,
                        'server_order' => $server->providerServer,
                        'quantity' => $quantity,
                        'reaction' => $request->reaction,
                        'speed' => 1,
                        'comment' => $request->comments,
                        'order_codes' => $orderCode,
                        'minutes' => $request->minutes,

                        'days' => $request->duration,
                        'post' => $request->posts,
                    ];

                    $result = $tds->createOrder();
                    if (isset($result['status']) && $result['status'] === true) {
                        $orderID = $result['data'];


                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['message'],
                        ], 400);
                    }
                } else if ($server->providerName == 'tuongtaccheo') {
                    $orderCode = site('madon') . '_' . time() . rand(1000, 9999);
                    $tds = new TuongtaccheoController();
                    $tds->path = $server->providerLink;
                    $tds->data = [
                        'object_id' => $request->object_id,
                        'server_order' => $server->providerServer,
                        'quantity' => $quantity,
                        'reaction' => $request->reaction,
                        'speed' => 1,
                        'comment' => $request->comments,
                        'order_code_api' => $orderCode,
                        'minutes' => $request->minutes,

                        'days' => $request->duration,
                        'post' => $request->posts,
                    ];

                    $result = $tds->createOrder();
                    if (isset($result['status']) && $result['status'] === true) {
                        $orderID = $orderCode;


                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['message'],
                        ], 400);
                    }
                } elseif ($server->providerName == '2mxh') {
                    $twoMXH = new TwoMxhController();
                    $twoMXH->path = $server->providerLink;
                    $twoMXH->data = [
                        'object_id' => $request->object_id,
                        'quantity' => $quantity,
                        'reaction' => $request->reaction,
                        'comment' => $request->comments,
                        'minutes' => $request->minutes,
                        'time' => $request->time,
                        'duration' => $request->duration,
                        'post' => $request->posts,
                        'server_order' => $server->providerServer,

                    ];

                    $result = $twoMXH->CreateOrder();
                    if (isset($result) && $result['status'] == true) {
                        $orderID = $result['data']['order']['order_id'];
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['message'],
                        ], 400);
                    }
                } elseif ($server->providerName == 'tuongtacpro') {
                    $orderCode = site('madon') . '_' . time() . rand(1000, 9999);
                    $twoMXH = new TuongtacproController();
                    $twoMXH->path = $server->providerLink;
                    $twoMXH->data = [
                        'object_id' => $request->object_id,
                        'quantity' => $quantity,
                        'reaction' => $request->reaction,
                        'comment' => $request->comments,
                        'minutes' => $request->minutes,
                        'time' => $request->time,
                        'duration' => $request->duration,
                        'post' => $request->posts,
                        'code_order_api' => $orderCode,
                        'server_order' => $server->providerServer,

                    ];

                    $result = $twoMXH->CreateOrder();
                    if (isset($result) && $result['status'] == true) {


                        $orderID = $orderCode;
                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['message'],
                        ], 400);
                    }
                } elseif ($server->providerName == 'sharegiare') {
                    $sharegr = new SharegiareController();
                    $sharegr->path = $server->providerLink;
                    $sharegr->data = [
                        'object_id' => $request->object_id,
                        'quantity' => $quantity,
                        'reaction' => $request->reaction,
                        'comment' => $request->comments,
                        'minutes' => $request->minutes,
                        'time' => $request->time,
                        'duration' => $request->duration,
                        'post' => $request->posts,
                        'server_order' => $server->providerServer,

                    ];

                    $result = $sharegr->CreateOrder();
                    if (isset($result) && $result['status'] == true) {
                        $orderID = $result['data'][0]['order_id'];
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['message'],
                        ], 400);
                    }
                } elseif ($server->providerName == 'baostar') {
                    $baoStar = new BaostarController();
                    $baoStar->path = $server->providerLink;
                    $baoStar->data = [
                        'object_id' => $request->object_id,
                        'quantity' => $quantity,
                        'object_type' => $request->reaction,
                        'package_name' => $server->providerServer,
                        'list_message' => $request->comments,
                        'num_minutes' => $request->minutes,
                        'num_day' => $request->duration,
                        'slbv' => $request->posts,
                    ];

                    $result = $baoStar->createOrder();
                    if (isset($result) && $result['status'] == true) {
                        $orderID = $result['data']['code_order'];
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['message'],
                        ], 400);
                    }
                } elseif ($server->providerName == 'boosterviews') {
                    $boosterviews = new BoosterviewsController();

                    $result = $boosterviews->order([
                        'service' => $server->providerServer,
                        'link' => $request->object_id,
                        'quantity' => $quantity,
                        'comments' => $request->comments,
                    ]);

                    if (isset($result) && $result['order']) {
                        $orderID = $result['order'];
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['message'],
                        ], 400);
                    }
                } elseif ($server->providerName == 'cheotuongtac') {
                    $cheotuongtac = new CheoTuongTacController();

                    $result = $cheotuongtac->order([
                        'service' => $server->providerServer,
                        'link' => $request->object_id,
                        'quantity' => $quantity,
                        'comments' => $request->comments,
                    ]);

                    if (isset($result) && $result['order']) {
                        $orderID = $result['order'];
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['message'],
                        ], 400);
                    }
                } elseif ($server->providerName == 'smmking') {
                    $smmking = new SmmKingController();

                    $result = $smmking->order([
                        'service' => $server->providerServer,
                        'link' => $request->object_id,
                        'quantity' => $quantity,
                        'comments' => $request->comments,
                    ]);

                    if (isset($result['order']) && !empty($result['order'])) {
                        $orderID = $result['order'];
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {

                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['error'] ?? $result['message'] ?? $result['msg'] ?? $result['status'] ?? 'Vui lòng thử lại sau',
                        ], 400);
                    }
                } elseif ($server->providerName == 'tuongtacsale') {
                    $tuongtacsale = new TuongTacSaleController();

                    $result = $tuongtacsale->order([
                        'service' => $server->providerServer,
                        'link' => $request->object_id,
                        'quantity' => $quantity,
                        'comments' => $request->comments,
                    ]);

                    if (isset($result) && $result['order']) {
                        $orderID = $result['order'];
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['message'],
                        ], 400);
                    }
                } elseif ($server->providerName == 'hacklike17') {

                    $hacklike17 = new Hacklike17Controller();
                    $hacklike17->data = [
                        'uid' => $request->object_id,
                        'count' => $quantity,
                        'server' => $server->providerServer,
                        'reaction' => $request->reaction,
                        'list_comment' => $request->comments,
                        'comments' => $request->comments,
                        'minutes' => $request->minutes,
                        'days' => $request->duration,
                    ];

                    $result = $hacklike17->order($server->providerLink);
                    if (isset($result) && $result['status'] == 1) {
                        $orderID = $result['order_id'];
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['msg'] ?? $result,
                        ], 400);
                    }
                } elseif ($server->providerName == 'conglike') {
                    $conglike = new CongLikeController();
                    $conglike->data = [
                        'post_id' => $request->object_id,
                        'page_id' => $request->object_id,
                        'soluong' => $quantity,
                        'num_package' => $request->duration,
                        'package_id' => $server->providerServer,
                    ];
                    $result = $conglike->order($server->providerLink);
                    if (isset($result) && $result['code'] == 100) {
                        $orderID = $request->object_id;
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            'posts' => $request->posts,
                            'duration' => $request->duration,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['message'],
                        ], 400);
                    }
                } elseif ($server->providerName == 'dontay') {
                    $orderID = time() . rand(1000, 9999);
                    $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                    $orderData = [
                        "user_id" => $user->id,
                        "service_id" => $service->id,
                        "server_id" => $server->id,
                        "order_code" => $orderCode,
                        "object_id" => $request->object_id,
                        "quantity" => $request->quantity,
                        "reaction" => $request->reaction,
                        "comments" => htmlentities($request->comments),
                        "minutes" => $request->minutes,
                        'posts' => $request->posts,
                        'duration' => $request->duration,
                        "price" => $price,
                        'payment' => $total,
                        'note' => $request->note,
                    ];
                } else {
                    $smm = Smm::where('domain', env('APP_MAIN_SITE'))->get();
                    foreach ($smm as $smms) {
                        if ($server->providerName == $smms['name']) {
                            $path = $smms['name'];

                            $post = array(
                                'key' => $smms['token'],
                                'action' => 'add',

                                'service' => $server->providerServer,
                                'link' => $request->object_id,
                                'minutes' => $request->minutes,
                                'quantity' => $quantity,
                                'comments' => $request->comments,
                                'reaction' => strtolower($request->reaction) ?? 'like'
                            );
                            $result = curl_smm($path, $post);
                            if (isset($result['order']) && !empty($result['order'])) {
                                $orderID = $result['order'];
                                $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                                $orderData = [
                                    "user_id" => $user->id,
                                    "service_id" => $service->id,
                                    "server_id" => $server->id,
                                    "order_code" => $orderCode,
                                    "object_id" => $request->object_id,
                                    "quantity" => $request->quantity,
                                    "reaction" => $request->reaction,
                                    "comments" => htmlentities($request->comments),
                                    "minutes" => $request->minutes,
                                    'posts' => $request->posts,
                                    'duration' => $request->duration,
                                    "price" => $price,
                                    'payment' => $total,
                                    'note' => $request->note,
                                ];
                            } else {

                                if ($result['error'] == 'neworder.error.link_duplicate') {
                                    $msg = 'Liên kết này đang hoạt động trên hệ thống. Vui lòng đợi đơn hàng hoàn thành !';
                                } else {
                                    $msg = 'Máy chủ hết tài nguyên, vui lòng liên hệ admin để được hỗ trợ !';
                                }

                                return response()->json([
                                    'code' => '400',
                                    'status' => 'error',
                                    'message' => $msg,
                                ], 400);
                            }
                        }
                        // else{
                        //     return response()->json([
                        //         'code' => '400',
                        //         'status' => 'error',
                        //         'message' =>'Hệ thống không hỗ trợ dịch vụ này!',
                        //     ], 400);
                        // }
                    }
                }

                $order = new Order();
                $order->user_id = $user->id;
                $order->service_id = $service->id;
                $order->server_id = $server->id;
                $order->orderProviderName = $server->providerName;
                $order->orderProviderPath = $server->providerLink;
                $order->orderProviderServer = $server->providerServer;
                $order->order_package = $service->package;
                $order->object_server = $provider_servers;
                $order->object_id = $request->object_id;
                $order->order_id = $orderID;
                $order->order_code = $orderCode;
                $order->order_data = json_encode($orderData);
                $order->start = 0;
                $order->buff = 0;
                $order->duration = $request->duration;
                $order->posts = 0;
                $order->remaining = $request->duration;
                $order->price = $price;
                $order->voucher = $request->voucher;
                $order->payment = $total;
                $order->status = 'Processing';
                $order->ip = $request->ip();
                $order->note = $request->note;
                $order->time = now();
                $order->domain = $domain;
                $order->save();

                if ($order) {

                    // nếu số dư của user nhỏ hơn total thì block user
                    if ($user->balance < $total) {
                        $user->status = 'banned';
                        $user->save();
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => 'Tài khoản của bạn đã bị khoá do thực hiện giao dịch không hợp lệ !',
                        ], 400);
                    }

                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->tran_code = $orderCode;
                    $transaction->type = 'order';
                    $transaction->action = 'sub';
                    $transaction->first_balance = $total;
                    $transaction->before_balance = $user->balance;
                    $transaction->after_balance = $user->balance - $total;
                    $transaction->note = 'Thanh toán đơn hàng ' . $orderCode;
                    $transaction->ip = $request->ip();
                    $transaction->domain = $domain;
                    $transaction->save();

                    $user->balance = $user->balance - $total;
                    $user->save();

                if ($server->providerName == 'dontay'){
                    if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id_dontay')) {
                        try {
                            $bot_notify = new TelegramSdk();
                            $bot_notify->botNotify()->sendMessage([
                                'chat_id' => siteValue('telegram_chat_id_dontay'),
                                'text' => '➤ <b>' . $domain . ' - Đơn tay cần duyệt' . "</b>\n" .
                                    '➤ <b>Khách hàng:</b> ' . $user->username . "\n" .
                                    '➤ <b>Dịch Vụ:</b> ' . $service->platform->name . ' ★ ' . $service->name . "\n" .
                                    '➤<b>Máy chủ:</b> ' . $server->id . "\n" .
                                    '➤ <b>Link:</b> ' . $request->object_id . "\n" .
                                    '➤ <b>Số lượng:</b> ' . number_format($request->quantity) . "\n" .
                                    '➤ <b>Mã Đơn:</b> ' . $order->order_code . "\n" .
                                    '➤ <b>Giao Dịch:</b> ' . number_format($transaction->before_balance) . 'đ' . ' - ' . number_format($total) . 'đ' . ' = ' . number_format($user->balance) . 'đ' . "\n" .
                                    '➤ <b>Ghi chú:</b> ' . $request->note . "\n",
                                'parse_mode' => 'HTML',
                            ]);
                        } catch (\Exception $e) {


                        }
                    }
                }

                    if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                        try {
                            $bot_notify = new TelegramSdk();
                            $bot_notify->botNotify()->sendMessage([
                                'chat_id' => siteValue('telegram_chat_id'),
                                'text' => '➤ <b>' . $domain . ' - Đơn hàng' . "</b>\n" .
                                    '➤ <b>Khách hàng:</b> ' . $user->username . "\n" .
                                    '➤ <b>Dịch Vụ:</b> ' . $service->platform->name . ' ★ ' . $service->name . "\n" .
                                    '➤<b>Máy chủ:</b> ' . $server->id . "\n" .
                                    '➤ <b>Link:</b> ' . $request->object_id . "\n" .
                                    '➤ <b>Số lượng:</b> ' . number_format($request->quantity) . "\n" .
                                    '➤ <b>Mã Đơn:</b> ' . $order->order_code . "\n" .
                                    '➤ <b>Giao Dịch:</b> ' . number_format($transaction->before_balance) . 'đ' . ' - ' . number_format($total) . 'đ' . ' = ' . number_format($user->balance) . 'đ' . "\n" .
                                    '➤ <b>Ghi chú:</b> ' . $request->note . "\n",
                                'parse_mode' => 'HTML',
                            ]);
                        } catch (\Exception $e) {


                        }
                    }

                    if ($user->telegram_id !== null && $user->notification_telegram) {
                        try {
                            $bot_notify = new TelegramSdk();
                            $bot_notify->botChat()->sendMessage([
                                'chat_id' => $user->telegram_id,
                                'text' => '🛒 <b>Bạn vừa tạo đơn hàng mới từ website ' . $domain . ' !' . "</b>\n\n" .
                                    '📦 <b>Gói dịch vụ:</b> ' . $service_platform->name . " - " . $service->name . "\n" .
                                    '🔗 <b>Link hoặc UID:</b> ' . $request->object_id . "\n" .
                                    '🔢 <b>Số lượng:</b> ' . number_format($request->quantity) . "\n" .
                                    '➤<b>Máy chủ:</b> ' . $server->id . "\n" .
                                    '💰 <b>Giá tiền:</b> ' . $price . 'đ' . "\n" .
                                    '💵 <b>Thanh toán:</b> ' . $total . 'đ' . "\n" .
                                    '📝 <b>Ghi chú:</b> ' . $request->note . "\n",
                                'parse_mode' => 'HTML',
                            ]);
                        } catch (\Exception $e) {


                        }
                    }

                    return response()->json([
                        'code' => '200',
                        'status' => 'success',
                        'message' => 'Đơn hàng của bạn đã được tạo thành công !',
                        'data' => [
                            'id' => $order->id,
                            'order_code' => $orderCode,
                            'price' => $price,
                            'payment' => $total,
                            'status' => 'Processing',
                        ],
                    ], 200);
                }
            } else {

                $partner = PartnerWebsite::where('name', getDomain())->first();

                $admin = User::where('id', $partner->user_id)->first();
                if (!$admin) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Không tìm thấy tài khoản admin !',
                    ], 400);
                }

                $service = Service::where('package', $request->provider_package)->where('domain', env('APP_MAIN_SITE'))->first();

                if (!$service) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Gói cần mua không tồn tại !',
                    ], 400);
                }

                if ($service->status !== 'active') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Gói cần mua hiện không khả dụng !',
                    ], 400);
                }

                $provider_servers = str_replace('sv-', '', $request->provider_server);


                $lam12 = explode("_", $provider_servers);
                $provider_server = $lam12[0];

                $server = ServiceServer::where('service_id', $service->id)->where('package_id', $provider_server)->where('domain', $domain)->first();

                $server_admin = ServiceServer::where('service_id', $service->id)->where('package_id', $server->package_id)->where('domain', $partner->domain)->first();

                if (!$server && !$server_admin) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Máy chủ này không tồn tại !',
                    ], 400);
                }

                if ($server->visibility !== 'public' && $server_admin->visibility !== 'public') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Máy chủ này không khả dụng !',
                    ], 400);
                }

                if ($server->status !== 'active' && $server_admin->status !== 'active') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Máy chủ này hiện đang bảo trì !',
                    ], 400);
                }

                $validService = Validator::make($request->all(), [
                    'object_id' => 'required',
                ], [
                    'object_id.required' => 'Vui lòng nhập UID hoặc Link cần mua !',
                ]);

                if ($validService->fails()) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => $validService->errors()->first(),
                    ], 400);
                }

                $serverAction = ServerAction::where('server_id', $server->id)->first();

                if (!$serverAction) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Máy chủ này hiện đang bị lỗi vui lòng thử lại sau !',
                    ], 400);
                }

                if ($serverAction->quantity_status === 'on') {
                    $valid = Validator::make($request->all(), [
                        'quantity' => 'required|integer'
                    ], [
                        'quantity.required' => 'Vui lòng chọn số lượng cần mua !',
                        'quantity.integer' => 'Số lượng cần mua phải là số !',
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $valid->errors()->first(),
                        ], 400);
                    }
                }

                if ($serverAction->reaction_status === 'on') {
                    $valid = Validator::make($request->all(), [
                        'reaction' => 'required'
                    ], [
                        'reaction.required' => 'Vui lòng cảm xúc !',
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $valid->errors()->first(),
                        ], 400);
                    }
                }

                if ($serverAction->comments_status === 'on') {
                    $valid = Validator::make($request->all(), [
                        'comments' => 'required'
                    ], [
                        'comments.required' => 'Vui lòng nhập nội dung bình luận !',
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $valid->errors()->first(),
                        ], 400);
                    }

                    $count = 0;
                    $comments = explode("\n", $request->comments);
                    $comments = array_filter($comments, 'trim');
                    $comments = array_values($comments);
                    $count = count($comments);
                    $request->merge(['quantity' => $count]);
                }

                if ($serverAction->minutes_status === 'on') {
                    $valid = Validator::make($request->all(), [
                        'minutes' => 'required|integer'
                    ], [
                        'minutes.required' => 'Vui lòng chọn Số Phút cần mua !',
                        'minutes.integer' => 'Số Phút cần mua phải là số !',
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $valid->errors()->first(),
                        ], 400);
                    }
                }

                if ($serverAction->posts_status === 'on') {
                    $valid = Validator::make($request->all(), [
                        'posts' => 'required'
                    ], [
                        'posts.required' => 'Vui lòng chọn số bài viết cần mua !',
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $valid->errors()->first(),
                        ], 400);
                    }
                    $newPost = $request->posts == 'unlimited' ? 1 : $request->posts;
                    $request->merge(['posts' => $newPost]);
                }

                if ($serverAction->time_status === 'on') {
                    $valid = Validator::make($request->all(), [
                        'duration' => 'required|integer'
                    ], [
                        'duration.required' => 'Vui lòng chọn số bài viết cần mua !',
                        'duration.integer' => 'Số bài viết cần mua phải là số !',
                    ]);

                    if ($valid->fails()) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $valid->errors()->first(),
                        ], 400);
                    }
                }

                if ($server->limit_day > 0) {
                    $orderToday = Order::where('server_id', $server->id)->whereDate('created_at', Carbon::today())->count();

                    if ($orderToday >= $request->quantity) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => 'Máy chủ này đã đạt giới hạn mua hàng trong ngày !',
                        ], 400);
                    }
                }

                if ($request->quantity < $server->min) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Số lượng cần mua phải lớn hơn hoặc bằng ' . $server->min . ' !',
                    ], 400);
                }

                if ($request->quantity > $server->max) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Số lượng cần mua phải nhỏ hơn hoặc bằng ' . $server->max . ' !',
                    ], 400);
                }

                $price = $server->levelPrice($user->level);
                $price_admin = $server_admin->levelPrice($admin->level);

                 
                   if (isset($request->voucher) && $request->voucher !== '') {
                    $voucher = Voucher::where('name', $request->voucher)->where('domain', getDomain())->first();
                    if ($voucher) {


                        $start = Carbon::parse($voucher->timeStart);
                        $end = Carbon::parse($voucher->timeEnd);
                        $nows = Carbon::now();
                        $now = Carbon::parse($nows);
                        if (!($now->between($start, $end, true) || $now->isSameDay($end))) {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'message' => 'Mã giảm giá đã hết hạn sử dụng!',
                            ], 400);
                        }

                        if ($voucher->limitUser !== '0') {
                            $orderVoucher = Order::where('voucher', $request->voucher)->where('domain', getDomain())->count();
                            if ($orderVoucher >= $voucher->limitUser) {
                                return response()->json([
                                    'code' => '400',
                                    'status' => 'error',
                                    'message' => 'Mã giảm giá đã hết luợt sử dụng !',
                                ], 400);
                            }
                        }
                        if ($voucher->user_voucher !== '0') {
                            $string = $voucher->user_voucher;


                            $search = $user->username;

                            $parts = array_map('trim', explode('|', $string));
                            if (!in_array($search, $parts)) {
                                return response()->json([
                                    'code' => '400',
                                    'status' => 'error',
                                    'message' => 'Bạn không nằm trong danh sách may mắn được sử dụng voucher này !',
                                ], 400);
                            }
                        }



                        if ($serverAction->time_status === 'on') {
                            $totals = $price * $request->quantity * $request->duration;
        
                            $total_admins = $price_admin * $request->quantity * $request->duration;

                            $total = $totals - ($totals * $voucher->percent / 100);
                            $total_admin = $total_admins - ($total_admins * $voucher->percent / 100);
                        } elseif ($serverAction->minutes_status === 'on') {
        
                            $totals = $price * $request->quantity * $request->minutes;
                            $total_admins = $price_admin * $request->quantity * $request->minutes;

                            $total = $totals - ($totals * $voucher->percent / 100);
                            $total_admin = $total_admins - ($total_admins * $voucher->percent / 100);
                        } elseif ($serverAction->minutes_status === 'on' && $serverAction->time_status === 'on') {
        
                            $totals = $price * $request->quantity * $request->minutes * $request->duration;
                            $total_admins = $price_admin * $request->quantity * $request->minutes * $request->duration;

                            $total = $totals - ($totals * $voucher->percent / 100);
                            $total_admin = $total_admins - ($total_admins * $voucher->percent / 100);
                        } elseif ($serverAction->posts_status === 'on') {
                            $posts = $request->posts == 'unlimited' ? 1 : $request->posts;
                            $totals = $price * $request->quantity * $posts;
        
                            $total_admins = $price_admin * $request->quantity * $posts;

                            $total = $totals - ($totals * $voucher->percent / 100);
                            $total_admin = $total_admins - ($total_admins * $voucher->percent / 100);
                        } elseif ($serverAction->time_status === 'on' && $serverAction->posts_status === 'on') {
                            $posts = $request->posts == 'unlimited' ? 1 : $request->posts;
                            $totals = $price * $request->quantity * $request->duration * $posts;
        
        
                            $total_admins = $price_admin * $request->quantity * $request->duration * $posts;

                            $total = $totals - ($totals * $voucher->percent / 100);
                            $total_admin = $total_admins - ($total_admins * $voucher->percent / 100);
                        } else {
                            $totals = $price * $request->quantity;
        
                            $total_admins = $price_admin * $request->quantity;

                            $total = $totals - ($totals * $voucher->percent / 100);
                            $total_admin = $total_admins - ($total_admins * $voucher->percent / 100);
                        }
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => 'Mã voucher giảm giá không hợp lệ !',
                        ], 400);
                    }
                } else {
                    if ($serverAction->time_status === 'on') {
                        $total = $price * $request->quantity * $request->duration;
    
                        $total_admin = $price_admin * $request->quantity * $request->duration;
                    } elseif ($serverAction->minutes_status === 'on') {
    
                        $total = $price * $request->quantity * $request->minutes;
                        $total_admin = $price_admin * $request->quantity * $request->minutes;
                    } elseif ($serverAction->minutes_status === 'on' && $serverAction->time_status === 'on') {
    
                        $total = $price * $request->quantity * $request->minutes * $request->duration;
                        $total_admin = $price_admin * $request->quantity * $request->minutes * $request->duration;
                    } elseif ($serverAction->posts_status === 'on') {
                        $posts = $request->posts == 'unlimited' ? 1 : $request->posts;
                        $total = $price * $request->quantity * $posts;
    
                        $total_admin = $price_admin * $request->quantity * $posts;
                    } elseif ($serverAction->time_status === 'on' && $serverAction->posts_status === 'on') {
                        $posts = $request->posts == 'unlimited' ? 1 : $request->posts;
                        $total = $price * $request->quantity * $request->duration * $posts;
    
    
                        $total_admin = $price_admin * $request->quantity * $request->duration * $posts;
                    } else {
                        $total = $price * $request->quantity;
    
                        $total_admin = $price_admin * $request->quantity;
                    }
                }


                


                if ($user->balance < ceil($total)) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Số dư của bạn không đủ để thực hiện giao dịch này !',
                    ], 400);
                }

                if ($admin->balance < ceil($total_admin)) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Số dư của bạn không đủ để thực hiện giao dịch này !',
                    ], 400);
                }

                /* if ($server->providerName == 'subgiare') {
                    $sgr = new SubgiareController();
                    $sgr->path = $server->providerLink;
                    $sgr->data = [
                        'object_id' => $request->object_id,
                        'server_order' => $server->providerServer,
                        'quantity' => $request->quantity,
                        'reaction' => $request->reaction,
                        'speed' => 'fast',
                        'comment' => $request->comments,
                        'minutes' => $request->minutes,
                        'time' => $request->time,
                        'days' => $request->duration,
                        'post' => $request->posts,
                    ];

                    $result = $sgr->createOrder();
                    if (isset($result) && $result['status'] === true) {
                        $orderID = $result['data']['code_order'];
                        $orderCode = site('madon').'_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $request->object_id,
                            "quantity" => $request->quantity,
                            "reaction" => $request->reaction,
                            "comments" => htmlentities($request->comments),
                            "minutes" => $request->minutes,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $request->note,
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['message'],
                        ], 400);
                    }
                }  */



                $urlOrder = "https://" . $partner->domain . "/api/v1/start/create/order";

                $dataSend = array(
                    'provider_package' => $request->provider_package,
                    'provider_server' => $provider_server,
                    'object_id' => $request->object_id,
                    'quantity' => $request->quantity,
                    'reaction' => $request->reaction,
                    'comments' => $request->comments,
                    'minutes' => $request->minutes,
                    'posts' => $request->posts,
                   
                    'duration' => $request->duration,
                    'note' => $request->getHost() . ' - Khởi tạo đơn hàng từ API',
                );

                $curl = curl_init();
                curl_setopt_array(
                    $curl,
                    array(
                        CURLOPT_URL => $urlOrder,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => json_encode($dataSend),
                        CURLOPT_HTTPHEADER => array(
                            'X-Access-Token: ' . $admin->api_token,
                            'Content-Type: application/json'
                        ),
                    )
                );

                $response = curl_exec($curl);

                curl_close($curl);
                $result = json_decode($response, true);
                if (isset($result) && $result['status'] == 'success') {
                    $orderID = $result['data']['id'];
                    $orderCode = '' . time() . rand(1000, 9999);

                    $orderData = [
                        "user_id" => $user->id,
                        "service_id" => $service->id,
                        "server_id" => $server->id,
                        "order_code" => $orderCode,
                        "object_id" => $request->object_id,
                        "quantity" => $request->quantity,
                        "reaction" => $request->reaction,
                        "comments" => htmlentities($request->comments),
                        "minutes" => $request->minutes,
                        "price" => $price,
                        'payment' => $total,
                        'note' => $request->note,
                    ];

                    $order = new Order();
                    $order->user_id = $user->id;
                    $order->service_id = $service->id;
                    $order->server_id = $server->id;
                    $order->orderProviderName = $partner->domain;
                    $order->orderProviderServer = $server->providerServer;
                    $order->order_package = $service->package;
                    $order->object_server = $provider_server;
                    $order->object_id = $request->object_id;
                    $order->order_id = $orderID;
                    $order->order_code = $orderCode;
                    $order->order_data = json_encode($orderData);
                    $order->start = 0;
                    $order->voucher = $request->voucher;
                    $order->buff = 0;
                    $order->duration = $request->duration;
                    $order->remaining = $request->duration;
                    $order->posts = 0;
                    $order->price = $price;
                    $order->payment = $total;
                    $order->status = 'Processing';
                    $order->ip = $request->ip();
                    $order->note = $request->note;
                    $order->time = now();
                    $order->domain = $domain;
                    $order->save();

                    if ($order) {

                        // nếu số dư của user nhỏ hơn total thì block user
                        if ($user->balance < $total) {
                            $user->status = 'banned';
                            $user->save();
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'message' => 'Tài khoản của bạn đã bị khoá do thực hiện giao dịch không hợp lệ !',
                            ], 400);
                        }

                        $transaction = new Transaction();
                        $transaction->user_id = $user->id;
                        $transaction->tran_code = $orderCode;
                        $transaction->type = 'order';
                        $transaction->action = 'sub';
                        $transaction->first_balance = $total;
                        $transaction->before_balance = $user->balance;
                        $transaction->after_balance = $user->balance - $total;
                        $transaction->note = 'Thanh toán đơn hàng ' . $orderCode;
                        $transaction->ip = $request->ip();
                        $transaction->domain = $domain;
                        $transaction->save();


                        $admin->balance = $admin->balance - $total_admin;
                        $admin->save();


                        $user->balance = $user->balance - $total;
                        $user->save();

                        if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                            $bot_notify = new TelegramSdk();
                            $bot_notify->botNotify()->sendMessage([
                                'chat_id' => siteValue('telegram_chat_id'),
                                'text' => '🛒 <b>Đơn hàng mới được tạo từ website ' . $domain . ' !' . "</b>\n\n" .
                                    '👤 <b>Khách hàng:</b> ' . $user->name . ' (' . $user->email . ')' . "\n" .
                                    '📦 <b>Gói dịch vụ:</b> ' . $service->name . "\n" .
                                    '🔗 <b>Link hoặc UID:</b> ' . $request->object_id . "\n" .
                                    '🔢 <b>Số lượng:</b> ' . number_format($request->quantity) . "\n" .
                                    '🔗 <b>ID Máy chủ:</b> ' . $server->id . "\n" .
                                    '💰 <b>Giá tiền:</b> ' . $price . 'đ' . "\n" .
                                    '💵 <b>Thanh toán:</b> ' . $total . 'đ' . "\n" .
                                    '📝 <b>Ghi chú:</b> ' . $request->note . "\n",
                                'parse_mode' => 'HTML',
                            ]);
                        }

                        if ($user->telegram_id !== null && $user->notification_telegram) {
                            $bot_chat = new TelegramSdk();
                            $bot_chat->botChat()->sendMessage([
                                'chat_id' => $user->telegram_id,
                                'text' => '🛒 <b>Bạn vừa tạo đơn hàng mới từ website ' . $domain . ' !' . "</b>\n\n" .
                                    '📦 <b>Gói dịch vụ:</b> ' . $service->name . "\n" .
                                    '🔗 <b>Link hoặc UID:</b> ' . $request->object_id . "\n" .
                                    '🔢 <b>Số lượng:</b> ' . number_format($request->quantity) . "\n" .
                                    '🔗 <b>ID Máy chủ:</b> ' . $server->id . "\n" .
                                    '💰 <b>Giá tiền:</b> ' . $price . 'đ' . "\n" .
                                    '💵 <b>Thanh toán:</b> ' . $total . 'đ' . "\n" .
                                    '📝 <b>Ghi chú:</b> ' . $request->note . "\n",
                                'parse_mode' => 'HTML',
                            ]);
                        }

                        return response()->json([
                            'code' => '200',
                            'status' => 'success',
                            'message' => 'Đơn hàng của bạn đã được tạo thành công !',
                            'data' => [
                                'id' => $order->id,
                                'order_code' => $orderCode,
                                'price' => $price,
                                'payment' => $total,
                                'status' => 'Processing',
                            ],
                        ], 200);
                    }
                } else {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => $result['message'] ?? "Tạo đơn hàng thất bại !",
                    ], 400);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => '500',
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }



    public function createV2Order(Request $request)
    {
        try {

            $api_token = $request->input('key');
            $server_id = $request->input('service');
            $action = $request->input('action');
            $objectId = $request->input('link');
            $quantity = $request->input('quantity');
            $posts = $request->input('posts');
            $days = $request->input('days');
            $minutes = $request->input('minutes') ?? 60;
            $comments = $request->input('comments') ?? '';
            $reaction = $request->input('reaction') ?? 'like';
            $time = $request->input('time');
            $note = $request->input('note');

            if (empty($api_token)) {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'error' => 'Invalid key!',
                ], 401);
            } elseif (empty($action)) {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'error' => 'Invalid action!',
                ], 401);
            } else {
                if ($action == 'add') {
                    $domain = $request->getHost();
                    $user = User::where('api_token', $api_token)->first();

                    if (!$user) {
                        return response()->json([
                            'code' => '401',
                            'status' => 'error',
                            'error' => 'Invalid user !',
                        ], 401);
                    }

                    if ($user->status !== 'active') {
                        return response()->json([
                            'code' => '401',
                            'status' => 'error',
                            'error' => 'User is blocked !',
                        ], 401);
                    }




                    $server = ServiceServer::where('id', $server_id)->where('domain', $domain)->first();
                    $service = Service::where('id', $server->service_id)->where('domain', env('APP_MAIN_SITE'))->first();
                    $service_platform = ServicePlatform::where('id', $service->platform_id)->first();
                    $servers_id = "sv-" . $server->package_id;
                    if (!$server) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'error' => 'Invalid service !',
                        ], 400);
                    }

                    if ($server->visibility !== 'public') {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'error' => 'Invalid service !',
                        ], 400);
                    }

                    if ($server->status !== 'active') {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'error' => 'Maintenance service!',
                        ], 400);
                    }


                    $serverAction = ServerAction::where('server_id', $server->id)->first();

                    if (!$serverAction) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'error' => 'Service error !',
                        ], 400);
                    }



                    if ($serverAction->comments_status === 'on') {


                        $count = 0;
                        $comments = explode("\n", $comments);
                        $comments = array_filter($comments, 'trim');
                        $comments = array_values($comments);
                        $count = count($comments);
                        $request->merge(['quantity' => $count]);
                    }


                    if ($serverAction->posts_status === 'on') {


                        $newPost = $posts == 'unlimited' ? 1 : $posts;
                        $request->merge(['posts' => $newPost]);
                    }



                    if ($server->limit_day > 0) {
                        $orderToday = Order::where('server_id', $server->id)->whereDate('created_at', Carbon::today())->count();

                        if ($orderToday >= $quantity) {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Service limited !',
                            ], 400);
                        }
                    }

                    if ($quantity < $server->min) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'error' => 'Invalid quantity',
                        ], 400);
                    }

                    if ($quantity > $server->max) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'error' => 'Invalid quantity',
                        ], 400);
                    }

                    $price = $server->levelPrice($user->level);

                    if ($serverAction->time_status === 'on') {
                        $total = $price * $quantity * $days;
                    } elseif ($serverAction->posts_status === 'on') {
                        $posts = $posts == 'unlimited' ? 1 : $posts;
                        $total = $price * $quantity * $posts;
                    } elseif ($serverAction->minutes_status === 'on') {

                        $total = $price * $quantity * $minutes;
                    } elseif ($serverAction->time_status === 'on' && $serverAction->posts_status === 'on') {
                        $posts = $posts == 'unlimited' ? 1 : $posts;
                        $total = $price * $quantity * $days * $posts;
                    } else {
                        $total = $price * $quantity;
                    }

                    if ($user->balance < ceil($total)) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'error' => 'Số dư của bạn không đủ để thực hiện giao dịch này !',
                        ], 400);
                    }
                    if (isset($server->percents)) {
                        $quantitys = $quantity * ($server->percents / 100);
                    } else {
                        $quantitys = $quantity;
                    }

                    if ($server->providerName == 'trumsubre') {
                        $sgr = new SubgiareController();
                        $sgr->path = $server->providerLink;
                        $sgr->data = [
                            'object_id' => $objectId,
                            'server_order' => $server->providerServer,
                            'quantity' => $quantitys,
                            'reaction' => $reaction,
                            'speed' => 'fast',
                            'comment' => $comments,
                            'minutes' => $minutes,
                            'time' => $time,
                            'days' => $days,
                            'post' => $posts,
                        ];

                        $result = $sgr->createOrder();
                        if (isset($result) && $result['status'] === true) {
                            $orderID = $result['data']['code_order'];
                            $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $objectId,
                                "quantity" => $quantity,
                                "reaction" => $reaction,
                                "comments" => htmlentities($comments),
                                "minutes" => $minutes,
                                'posts' => $posts,
                                'duration' => $days,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $note,
                            ];
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Máy chủ hết tài nguyên, vui lòng liên hệ admin để được hỗ trợ !',
                            ], 400);
                        }
                    } else if ($server->providerName == 'tanglikeauto') {
                        $tanglike = new TanglikeautoController();
                        $tanglike->path = $server->providerLink;
                        $tanglike->data = [
                            'object_id' => $request->object_id,
                            'server_order' => $server->providerServer,
                            'quantity' => $quantitys,
                            'reaction' => $request->reaction,
                            'speed' => 'fast',
                            'comment' => $request->comments,
                            'minutes' => $request->minutes,
                            'time' => $request->time,
                            'days' => $request->duration,
                            'post' => $request->posts,
                        ];

                        $result = $tanglike->createOrder();
                        if (isset($result['status']) && $result['status'] === 'success') {
                            $orderID = $result['order_id'];
                            $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $request->object_id,
                                "quantity" => $quantity,
                                "reaction" => $request->reaction,
                                "comments" => htmlentities($request->comments),
                                "minutes" => $request->minutes,
                                'posts' => $request->posts,
                                'duration' => $request->duration,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $request->note,
                            ];
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Máy chủ hết tài nguyên, vui lòng liên hệ admin để được hỗ trợ !',
                            ], 400);
                        }
                    } else if ($server->providerName == 'tuongtaccheo') {
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);
                        $tds = new TuongtaccheoController();
                        $tds->path = $server->providerLink;
                        $tds->data = [
                            'object_id' => $objectId,
                            'server_order' => $server->providerServer,
                            'quantity' => $quantitys,
                            'reaction' => $reaction,
                            'speed' => 1,
                            'comment' => $comments,
                            'order_code_api' => $orderCode,
                            'minutes' => $minutes,

                            'days' => $days,
                            'post' => $posts,
                        ];

                        $result = $tds->createOrder();
                        if (isset($result['status']) && $result['status'] === true) {
                            $orderID = $orderCode;


                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $objectId,
                                "quantity" => $quantity,
                                "reaction" => $reaction,
                                "comments" => htmlentities($comments),
                                "minutes" => $minutes,
                                'posts' => $posts,
                                'duration' => $days,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $note,
                            ];
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Đã có lỗi xảy ra liên hệ cho xếp ADMIN ngay!',
                            ], 400);
                        }
                    } else if ($server->providerName == 'traodoisub') {
                        $orderCode = time() . rand(1000, 9999);
                        $tds = new TraodoisubController();
                        $tds->path = $server->providerLink;
                        $tds->data = [
                            'object_id' => $objectId,
                            'server_order' => $server->providerServer,
                            'quantity' => $quantitys,
                            'reaction' => $reaction,
                            'speed' => 1,
                            'comment' => $comments,
                            'order_codes' => $orderCode,
                            'minutes' => $minutes,
                            'time' => $time,
                            'days' => $days,
                            'post' => $posts,
                        ];

                        $result = $tds->createOrder();
                        if (isset($result['status']) && $result['status'] === true) {
                            $orderID = $result['data'];


                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $objectId,
                                "quantity" => $quantity,
                                "reaction" => $reaction,
                                "comments" => htmlentities($comments),
                                "minutes" => $minutes,
                                'posts' => $posts,
                                'duration' => $days,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $note,
                            ];
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Đã có lỗi xảy ra liên hệ cho xếp ADMIN ngay!',
                            ], 400);
                        }
                    } elseif ($server->providerName == '2mxh') {
                        $twoMXH = new TwoMxhController();
                        $twoMXH->path = $server->providerLink;
                        $twoMXH->data = [
                            'object_id' => $objectId,
                            'quantity' => $quantitys,
                            'reaction' => $reaction,
                            'comment' => $comments,
                            'minutes' => $minutes,
                            'time' => $time,
                            'duration' => $days,
                            'post' => $posts,
                            'server_order' => $server->providerServer,

                        ];

                        $result = $twoMXH->CreateOrder();
                        if (isset($result) && $result['status'] == true) {
                            $orderID = $result['data']['order']['order_id'];
                            $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $objectId,
                                "quantity" => $quantity,
                                "reaction" => $reaction,
                                "comments" => htmlentities($comments),
                                "minutes" => $minutes,
                                'posts' => $posts,
                                'duration' => $days,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $note,
                            ];
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Máy chủ hết tài nguyên, vui lòng liên hệ admin để được hỗ trợ !',
                            ], 400);
                        }
                    } elseif ($server->providerName == 'tuongtacpro') {
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);
                        $twoMXH = new TuongtacproController();
                        $twoMXH->path = $server->providerLink;
                        $twoMXH->data = [
                            'object_id' => $objectId,
                            'quantity' => $quantitys,
                            'reaction' => $reaction,
                            'comment' => $comments,
                            'minutes' => $minutes,
                            'time' => $time,
                            'duration' => $days,
                            'post' => $posts,
                            'code_order_api' => $orderCode,
                            'server_order' => $server->providerServer,

                        ];

                        $result = $twoMXH->CreateOrder();
                        if (isset($result) && $result['status'] == true) {


                            $orderID = $orderCode;
                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $objectId,
                                "quantity" => $quantity,
                                "reaction" => $reaction,
                                "comments" => htmlentities($comments),
                                "minutes" => $minutes,
                                'posts' => $posts,
                                'duration' => $days,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $note,
                            ];
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Máy chủ hết tài nguyên, vui lòng liên hệ admin để được hỗ trợ !',
                            ], 400);
                        }
                    } elseif ($server->providerName == 'sharegiare') {
                        $twoMXH = new SharegiareController();
                        $twoMXH->path = $server->providerLink;
                        $twoMXH->data = [
                            'object_id' => $objectId,
                            'quantity' => $quantitys,
                            'reaction' => $reaction,
                            'comment' => $comments,
                            'minutes' => $minutes,
                            'time' => $time,
                            'duration' => $days,
                            'post' => $posts,
                            'server_order' => $server->providerServer,

                        ];

                        $result = $twoMXH->CreateOrder();
                        if (isset($result) && $result['status'] == true) {
                            $orderID = $result['data'][0]['order_id'];
                            $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $objectId,
                                "quantity" => $quantity,
                                "reaction" => $reaction,
                                "comments" => htmlentities($comments),
                                "minutes" => $minutes,
                                'posts' => $posts,
                                'duration' => $days,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $note,
                            ];
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Máy chủ hết tài nguyên, vui lòng liên hệ admin để được hỗ trợ !',
                            ], 400);
                        }
                    } elseif ($server->providerName == 'baostar') {
                        $baoStar = new BaostarController();
                        $baoStar->path = $server->providerLink;
                        $baoStar->data = [
                            'object_id' => $objectId,
                            'quantity' => $quantitys,
                            'object_type' => $reaction,
                            'package_name' => $server->providerServer,
                            'list_message' => $comments,
                            'num_minutes' => $minutes,
                            'num_day' => $days,
                            'slbv' => $posts,
                        ];

                        $result = $baoStar->createOrder();
                        if (isset($result) && $result['status'] == true) {
                            $orderID = $result['data']['code_order'];
                            $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $objectId,
                                "quantity" => $quantity,
                                "reaction" => $reaction,
                                "comments" => htmlentities($comments),
                                "minutes" => $minutes,
                                'posts' => $posts,
                                'duration' => $days,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $note,
                            ];
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Máy chủ hết tài nguyên, vui lòng liên hệ admin để được hỗ trợ !',
                            ], 400);
                        }
                    } elseif ($server->providerName == 'boosterviews') {
                        $boosterviews = new BoosterviewsController();

                        $result = $boosterviews->order([
                            'service' => $server->providerServer,
                            'link' => $objectId,
                            'quantity' => $quantitys,
                            'comments' => $comments,
                        ]);

                        if (isset($result) && $result['order']) {
                            $orderID = $result['order'];
                            $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $objectId,
                                "quantity" => $quantity,
                                "reaction" => $reaction,
                                "comments" => htmlentities($comments),
                                "minutes" => $minutes,
                                'posts' => $posts,
                                'duration' => $days,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $note,
                            ];
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Máy chủ hết tài nguyên, vui lòng liên hệ admin để được hỗ trợ !',
                            ], 400);
                        }
                    } elseif ($server->providerName == 'cheotuongtac') {
                        $cheotuongtac = new CheoTuongTacController();

                        $result = $cheotuongtac->order([
                            'service' => $server->providerServer,
                            'link' => $objectId,
                            'quantity' => $quantitys,
                            'comments' => $comments,
                        ]);

                        if (isset($result) && $result['order']) {
                            $orderID = $result['order'];
                            $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $objectId,
                                "quantity" => $quantity,
                                "reaction" => $reaction,
                                "comments" => htmlentities($comments),
                                "minutes" => $minutes,
                                'posts' => $posts,
                                'duration' => $days,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $note,
                            ];
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Máy chủ hết tài nguyên, vui lòng liên hệ admin để được hỗ trợ !',
                            ], 400);
                        }
                    } elseif ($server->providerName == 'smmking') {
                        $smmking = new SmmKingController();

                        $result = $smmking->order([
                            'service' => $server->providerServer,
                            'link' => $objectId,
                            'quantity' => $quantitys,
                            'comments' => $comments,
                        ]);

                        if (isset($result['order']) && !empty($result['order'])) {
                            $orderID = $result['order'];
                            $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $objectId,
                                "quantity" => $quantity,
                                "reaction" => $reaction,
                                "comments" => htmlentities($comments),
                                "minutes" => $minutes,
                                'posts' => $posts,
                                'duration' => $days,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $note,
                            ];
                        } else {
                            if (isset($result['error'])) {
                                $msg = $result['error'];
                            } else if (isset($result['message'])) {
                                $msg = $result['message'];
                            } else if (isset($result['msg'])) {
                                $msg = $result['msg'];
                            }
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => $msg
                            ], 400);
                        }
                    } elseif ($server->providerName == 'tuongtacsale') {
                        $tuongtacsale = new TuongTacSaleController();

                        $result = $tuongtacsale->order([
                            'service' => $server->providerServer,
                            'link' => $objectId,
                            'quantity' => $quantitys,
                            'comments' => $comments,
                        ]);

                        if (isset($result) && $result['order']) {
                            $orderID = $result['order'];
                            $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $objectId,
                                "quantity" => $quantity,
                                "reaction" => $reaction,
                                "comments" => htmlentities($comments),
                                "minutes" => $minutes,
                                'posts' => $posts,
                                'duration' => $days,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $note,
                            ];
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Máy chủ hết tài nguyên, vui lòng liên hệ admin để được hỗ trợ !',
                            ], 400);
                        }
                    } elseif ($server->providerName == 'hacklike17') {

                        $hacklike17 = new Hacklike17Controller();
                        $hacklike17->data = [
                            'uid' => $objectId,
                            'count' => $quantitys,
                            'server' => $server->providerServer,
                            'reaction' => $reaction,
                            'list_comment' => $comments,
                            'comments' => $comments,
                            'minutes' => $minutes,
                            'days' => $days,
                        ];

                        $result = $hacklike17->order($server->providerLink);
                        if (isset($result) && $result['status'] == 1) {
                            $orderID = $result['order_id'];
                            $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $objectId,
                                "quantity" => $quantity,
                                "reaction" => $reaction,
                                "comments" => htmlentities($comments),
                                "minutes" => $minutes,
                                'posts' => $posts,
                                'duration' => $days,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $note,
                            ];
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => $result['msg'],
                            ], 400);
                        }
                    } elseif ($server->providerName == 'conglike') {
                        $conglike = new CongLikeController();
                        $conglike->data = [
                            'post_id' => $objectId,
                            'page_id' => $objectId,
                            'soluong' => $quantitys,
                            'num_package' => $days,
                            'package_id' => $server->providerServer,
                        ];
                        $result = $conglike->order($server->providerLink);
                        if (isset($result) && $result['code'] == 100) {
                            $orderID = $objectId;
                            $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $objectId,
                                "quantity" => $quantity,
                                "reaction" => $reaction,
                                "comments" => htmlentities($comments),
                                "minutes" => $minutes,
                                'posts' => $posts,
                                'duration' => $days,
                                "price" => $price,
                                'payment' => $total,
                                'note' => $note,
                            ];
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Máy chủ hết tài nguyên, vui lòng liên hệ admin để được hỗ trợ !',
                            ], 400);
                        }
                    } elseif ($server->providerName == 'dontay') {
                        $orderID = time() . rand(1000, 9999);
                        $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $objectId,
                            "quantity" => $quantity,
                            "reaction" => $reaction,
                            "comments" => htmlentities($comments),
                            "minutes" => $minutes,
                            'posts' => $posts,
                            'duration' => $days,
                            "price" => $price,
                            'payment' => $total,
                            'note' => $note,
                        ];
                    } else {
                        $smm = Smm::where('domain', env('APP_MAIN_SITE'))->get();
                        foreach ($smm as $smms) {
                            if ($server->providerName == $smms['name']) {
                                $path = $smms['name'];

                                $post = array(
                                    'key' => $smms['token'],
                                    'action' => 'add',
                                    'service' => $server->providerServer,
                                    'link' => $objectId,
                                    'quantity' => $quantitys,
                                    'comments' => $comments,
                                    'reaction' => strtolower($reaction) ?? 'like'
                                );
                                $result = curl_smm($path, $post);
                                if (isset($result['order']) && !empty($result['order'])) {
                                    $orderID = $result['order'];
                                    $orderCode = site('madon') . '_' . time() . rand(1000, 9999);

                                    $orderData = [
                                        "user_id" => $user->id,
                                        "service_id" => $service->id,
                                        "server_id" => $server->id,
                                        "order_code" => $orderCode,
                                        "object_id" => $objectId,
                                        "quantity" => $quantity,
                                        "reaction" => $reaction,
                                        "comments" => htmlentities($comments),
                                        "minutes" => $minutes,
                                        'posts' => $posts,
                                        'duration' => $days,
                                        "price" => $price,
                                        'payment' => $total,
                                        'note' => $note,
                                    ];
                                } else {
                                    if (isset($result['error'])) {
                                        $msg = $result['error'];
                                    } else if (isset($result['message'])) {
                                        $msg = $result['message'];
                                    } else if (isset($result['msg'])) {
                                        $msg = $result['msg'];
                                    } else if (isset($result['status'])) {
                                        $msg = $result['status'];
                                    }
                                    return response()->json([
                                        'code' => '400',
                                        'status' => 'error',
                                        'error' => 'Máy chủ hết tài nguyên, vui lòng liên hệ admin để được hỗ trợ !',
                                    ], 400);
                                }
                            }
                            // else{
                            //     return response()->json([
                            //         'code' => '400',
                            //         'status' => 'error',
                            //         'message' =>'Hệ thống không hỗ trợ dịch vụ này!',
                            //     ], 400);
                            // }
                        }
                    }

                    $order = new Order();
                    $order->user_id = $user->id;
                    $order->service_id = $service->id;
                    $order->server_id = $server->id;
                    $order->orderProviderName = $server->providerName;
                    $order->orderProviderPath = $server->providerLink;
                    $order->orderProviderServer = $server->providerServer;
                    $order->order_package = $service->package;
                    $order->object_server = $servers_id;
                    $order->object_id = $objectId;
                    $order->order_id = $orderID;
                    $order->order_code = $orderCode;
                    $order->order_data = json_encode($orderData);
                    $order->start = 0;
                    $order->buff = 0;
                    $order->duration = $days;
                    $order->posts = 0;
                    $order->remaining = $days;
                    $order->price = $price;
                    $order->payment = $total;
                    $order->status = 'Processing';
                    $order->ip = $request->ip();
                    $order->note = $note;
                    $order->time = now();
                    $order->domain = $domain;
                    $order->save();

                    if ($order) {

                        // nếu số dư của user nhỏ hơn total thì block user
                        if ($user->balance < $total) {
                            $user->status = 'banned';
                            $user->save();
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'error' => 'Tài khoản của bạn đã bị khoá do thực hiện giao dịch không hợp lệ !',
                            ], 400);
                        }

                        $transaction = new Transaction();
                        $transaction->user_id = $user->id;
                        $transaction->tran_code = $orderCode;
                        $transaction->type = 'order';
                        $transaction->action = 'sub';
                        $transaction->first_balance = $total;
                        $transaction->before_balance = $user->balance;
                        $transaction->after_balance = $user->balance - $total;
                        $transaction->note = 'Thanh toán đơn hàng ' . $orderCode;
                        $transaction->ip = $request->ip();
                        $transaction->domain = $domain;
                        $transaction->save();

                        $user->balance = $user->balance - $total;
                        $user->save();

                        if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                            try {
                                $bot_notify = new TelegramSdk();
                                $bot_notify->botNotify()->sendMessage([
                                    'chat_id' => siteValue('telegram_chat_id'),
                                    'text' => '🛒 <b>Đơn hàng mới được tạo từ website ' . $domain . ' !' . "</b>\n\n" .
                                        '👤 <b>Khách hàng:</b> ' . $user->name . ' (' . $user->email . ')' . "\n" .
                                        '📦 <b>Gói dịch vụ:</b> ' . $service_platform->name . " - " . $service->name . "\n" .
                                        '🔗 <b>Link hoặc UID:</b> ' . $objectId . "\n" .
                                        '🔢 <b>Số lượng:</b> ' . number_format($quantity) . "\n" .
                                        '🔗 <b>Server Máy chủ:</b> ' . $server->package_id . "\n" .
                                        '💰 <b>Giá tiền:</b> ' . $price . 'đ' . "\n" .
                                        '💵 <b>Thanh toán:</b> ' . $total . 'đ' . "\n" .
                                        '📝 <b>Ghi chú:</b> ' . $note . "\n",
                                    'parse_mode' => 'HTML',
                                ]);
                            } catch (\Exception $e) {


                            }
                        }

                        if ($user->telegram_id !== null && $user->notification_telegram) {
                            try {
                                $bot_notify = new TelegramSdk();
                                $bot_notify->botChat()->sendMessage([
                                    'chat_id' => $user->telegram_id,
                                    'text' => '🛒 <b>Bạn vừa tạo đơn hàng mới từ website ' . $domain . ' !' . "</b>\n\n" .
                                        '📦 <b>Gói dịch vụ:</b> ' . $service_platform->name . " - " . $service->name . "\n" .
                                        '🔗 <b>Link hoặc UID:</b> ' . $objectId . "\n" .
                                        '🔢 <b>Số lượng:</b> ' . number_format($quantity) . "\n" .
                                        '🔗 <b>Server Máy chủ:</b> ' . $server->package_id . "\n" .
                                        '💰 <b>Giá tiền:</b> ' . $price . 'đ' . "\n" .
                                        '💵 <b>Thanh toán:</b> ' . $total . 'đ' . "\n" .
                                        '📝 <b>Ghi chú:</b> ' . $note . "\n",
                                    'parse_mode' => 'HTML',
                                ]);
                            } catch (\Exception $e) {


                            }
                        }

                        return response()->json([
                            'order' => $order->id

                        ], 200);
                    }
                } else if ($action == "status") {
                    $idorder = $request->input('order');
                    $idorders = $request->input('orders');
                    if (!empty($idorder)) {
                        $user = User::where('domain', getDomain())->where('api_token', $api_token)->first();
                        if ($user) {
                            $order = Order::where('user_id', $user->id)->where('id', $idorder)->first();

                            if ($order) {
                                if ($order->status == 'Processing') {
                                    $stt = 'Pending';
                                } elseif ($order->status == 'Active') {
                                    $stt = 'In progress';
                                } elseif ($order->status == 'Running') {
                                    $stt = 'In progress';
                                } elseif ($order->status == 'Completed') {
                                    $stt = 'Completed';
                                } elseif ($order->status == 'Success') {
                                    $stt = 'Completed';
                                } elseif ($order->status == 'Refund') {
                                    $stt = 'Refunded';
                                } elseif ($order->status == 'Canceled') {
                                    $stt = 'Canceled';
                                } elseif ($order->status == 'Cancelled') {
                                    $stt = 'Canceled';
                                }
                                $quanttt = json_decode($order->order_data)->quantity;
                                $ketqua = array(
                                    'charge' => $order->price,
                                    'start_count' => $order->start,
                                    'status' => $stt,
                                    'remains' => $quanttt - $order->buff,
                                    "currency" => "VND"
                                );
                                echo json_encode($ketqua);
                            } else {
                                $ketqua = array('error' => 'Incorrect order ID');
                                echo json_encode($ketqua);
                            }
                        } else {
                            $ketqua = array('error' => 'Incorrect Key!');
                            echo json_encode($ketqua);
                        }
                    } elseif (!empty($idorders)) {
                        $data1 = explode(",", htmlspecialchars($idorders));
                        $soluong = count($data1);
                        $user = User::where('domain', getDomain())->where('api_token', $api_token)->first();
                        if ($user) {

                            if ($soluong < 100) {
                                $hash = '';
                                for ($i = 0; $i < $soluong; $i++) {
                                    $order = Order::where('user_id', $user->id)->where('id', $data1[$i])->first();
                                    if (!$order) {
                                        $ketqua[$i] = array('error' => 'Incorrect order ID');
                                    } else {
                                        $order = Order::where('user_id', $user->id)->where('id', $data1[$i])->first();
                                        if ($order->status == 'Processing') {
                                            $stt = 'Pending';
                                        } elseif ($order->status == 'Active') {
                                            $stt = 'In progress';
                                        } elseif ($order->status == 'Running') {
                                            $stt = 'In progress';
                                        } elseif ($order->status == 'Completed') {
                                            $stt = 'Completed';
                                        } elseif ($order->status == 'Success') {
                                            $stt = 'Completed';
                                        } elseif ($order->status == 'Refund') {
                                            $stt = 'Refunded';
                                        } elseif ($order->status == 'Canceled') {
                                            $stt = 'Canceled';
                                        } elseif ($order->status == 'Cancelled') {
                                            $stt = 'Canceled';
                                        }
                                        $quanttt = json_decode($order->order_data)->quantity;
                                        $ketqua[$i] = array(
                                            'charge' => $order->payment,
                                            'start_count' => $order->start,
                                            'status' => $stt,
                                            'remains' => $quanttt - $order->buff,
                                            "currency" => "VND"
                                        );

                                    }
                                }
                                echo json_encode(array_combine($data1, $ketqua));
                            } else {
                                echo json_encode(array('error' => "Maximum orders is 200 one time"));
                                exit();
                            }
                        } else {
                            $ketqua = array('error' => 'Incorrect Key!');
                            echo json_encode($ketqua);
                        }
                    }
                } else if ($action == "services") {
                    $user = User::where('domain', getDomain())->where('api_token', $api_token)->first();
                    if ($user) {
                        $server_service = ServiceServer::where('domain', getDomain())->get();
                        $arr = [];
                        foreach ($server_service as $sv) {
                            $lam = Service::where('id', $sv->service_id)->first();
                            $soc = ServicePlatform::where('id', $lam->platform_id)->first();
                            $arr[] = [
                                "service" => $sv->id,
                                "name" => $sv->name,
                                "type" => 'Default',
                                "category" => ucfirst($soc->name . '|' . $lam->name),
                                "rate" => $sv->levelPrice($user->level),
                                "min" => $sv->min,
                                "max" => $sv->max,
                                "currency" => "VND"
                            ];
                        }
                        return response()->json(

                            $arr
                        );
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'error' => 'Invalid Key!'
                        ]);
                    }
                } elseif ($action == 'balance') {

                    $user = User::where('domain', getDomain())->where('api_token', $api_token)->first();
                    if ($user) {
                        return response()->json([
                            'balance' => $user->balance,
                            'currency' => 'VND'
                        ]);
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'error' => 'Invalid Key!'
                        ]);
                    }
                }

            }

        } catch (\Exception $e) {
            return response()->json([
                'code' => '500',
                'status' => 'error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function refundOrder(Request $request)
    {
        try {
            $api_token = $request->header('X-Access-Token');

            if (!$api_token) {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'Không tìm thấy X-Access-Token !',
                ], 401);
            }

            $domain = $request->getHost();
            $user = User::where('api_token', $api_token)->where('domain', $domain)->first();

            if (!$user) {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'X-Access-Token không hợp lệ !',
                ], 401);
            }

            if ($user->status !== 'active') {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'Tài khoản của bạn hiện tại không được phép thực hiện hành động này !',
                ], 401);
            }

            $valid = Validator::make($request->all(), [
                'order_code' => 'required',
            ], [
                'order_code.required' => 'Vui lòng nhập mã đơn hàng cần hoàn tiền !',
            ]);

            if ($valid->fails()) {
                return response()->json([
                    'code' => '400',
                    'status' => 'error',
                    'message' => $valid->errors()->first(),
                ], 400);
            } else {
                $order = Order::where('order_code', $request->order_code)->where('user_id', $user->id)->where('domain', $domain)->first();
                if (!$order) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Không tìm thấy đơn hàng cần hoàn tiền !',
                    ], 400);
                }

                if ($order->status === 'Refunded') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã được hoàn tiền trước đó !',
                    ], 400);
                }

                if ($order->status === 'WaitingForRefund') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đang chờ hoàn tiền !',
                    ], 400);
                }

                if ($order->status === 'Completed') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã hoàn thành không thể hoàn tiền !',
                    ], 400);
                }

                if ($order->status === 'Cancelled') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã bị hủy không thể hoàn tiền !',
                    ], 400);
                }

                if ($order->status === 'Failed') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã thất bại không thể hoàn tiền !',
                    ], 400);
                }

                if ($order->status === 'Partially Refunded') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã được hoàn tiền một phần không thể hoàn tiền !',
                    ], 400);
                }

                if ($order->status === 'Partially Completed') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã hoàn thành một phần không thể hoàn tiền !',
                    ], 400);
                }

                $server = $order->server;
                if ($server) {

                    $action = $server->action;
                    if (!$action) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => 'Không tìm thấy thông tin máy chủ !',
                        ], 400);
                    }

                    if ($action->refund_status !== 'on') {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => 'Máy chủ này không hỗ trợ hoàn tiền !',
                        ], 400);
                    }

                    if ($server->providerName == '2mxh') {
                        $twoMXH = new TwoMxhController();
                        $twoMXH->path = $server->providerLink;
                        $result = $twoMXH->orderRefund($order->order_id);
                        if (isset($result) && $result['status'] === true) {
                            $order->status = 'WaitingForRefund';
                            $order->save();
                            return response()->json([
                                'code' => '200',
                                'status' => 'success',
                                'message' => 'Đơn hàng của bạn đã được đưa vào hàng chờ hoàn tiền !',
                            ], 200);
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'message' => $result['message'],
                            ], 400);
                        }
                    } elseif ($server->providerName == 'dontay') {

                        if ($server->action->time_status == 'on') {
                            $order->remaining = 0;
                            $order->status = 'Refunded';
                            $order->save();

                            // send notify telegram
                            if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                                try {
                                    $bot_notify = new TelegramSdk();
                                    $bot_notify->botNotify()->sendMessage([
                                        'chat_id' => siteValue('telegram_chat_id'),
                                        'text' => '🛒 <b>Đơn hàng đã được hoàn tiền từ website ' . $domain . ' !' . "</b>\n\n" .
                                            '👤 <b>Khách hàng:</b> ' . $user->name . ' (' . $user->email . ')' . "\n" .
                                            '📦 <b>Gói dịch vụ:</b> ' . $order->service->package . "\n" .
                                            '🔗 <b>Link hoặc UID:</b> ' . $order->object_id . "\n" .
                                            '🔢 <b>Số lượng:</b> ' . number_format($order->quantity) . "\n" .
                                            '🔗 <b>Máy chủ:</b> ' . $server->package_id . "\n" .
                                            '💰 <b>Giá tiền:</b> ' . $order->price . 'đ' . "\n" .
                                            '💵 <b>Thanh toán:</b> ' . $order->payment . 'đ' . "\n" .
                                            '📝 <b>Ghi chú:</b> ' . $order->note . "\n",
                                        'parse_mode' => 'HTML',
                                    ]);
                                } catch (\Exception $e) {


                                }
                            }


                            return response()->json([
                                'code' => '200',
                                'status' => 'success',
                                'message' => 'Đơn hàng của bạn đã được hoàn tiền !',
                            ], 200);
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'message' => 'Đơn hàng này không hỗ trợ hủy hoàn, trân trọng!',
                            ], 400);
                        }
                    } else {


                        ###smm
                        $tran = Transaction::where('tran_code', $order->order_id)->first();

                        if ($tran) {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'message' => 'Đơn hàng đang trong quá trình hủy vui lòng chờ !',
                            ], 400);
                        }
                        if ($user->balance < 1000) {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'message' => 'Tài khoản của bạn không đủ 1000 vnd để thực hiện yêu cầu hủy !',
                            ], 400);
                        }
                        $smms = Smm::where('domain', env('APP_MAIN_SITE'))->where('name', $order->orderProviderName)->first();


                        $path = $smms->name;

                        $post = array(
                            'key' => $smms->token,
                            'action' => 'cancel',

                            'order' => $order->order_id

                        );
                        $result = curl_smm($path, $post);
                        if (isset($result['cancel']) && !empty($result['cancel'])) {


                            $transaction = new Transaction();
                            $transaction->user_id = $user->id;
                            $transaction->tran_code = $order->order_id;
                            $transaction->type = 'refund';
                            $transaction->action = 'sub';
                            $transaction->first_balance = 1000;
                            $transaction->before_balance = $user->balance;
                            $transaction->after_balance = $user->balance - 1000;
                            $transaction->note = 'Thực hiện thao tác hủy hoàn mã đơn ' . $order->order_code . ' với chi phí hủy là 1000 vnđ';
                            $transaction->ip = $request->ip();
                            $transaction->domain = $domain;
                            $transaction->save();

                            $user->balance = $user->balance - 1000;
                            $user->save();
                            return response()->json([
                                'code' => '200',
                                'status' => 'success',
                                'message' => 'Đơn hàng của bạn đã được gửi yêu cầu hủy hoàn!',
                            ], 200);


                        } else {


                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'message' => 'Đơn hàng này không hỗ trợ hủy hoàn, trân trọng!',
                            ], 400);
                        }
                    }

                } else {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Không tìm thấy máy chủ của đơn hàng này !',
                    ], 400);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => '500',
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function warrantyOrder(Request $request)
    {
        try {
            $api_token = $request->header('X-Access-Token');

            if (!$api_token) {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'Không tìm thấy X-Access-Token !',
                ], 401);
            }

            $domain = $request->getHost();
            $user = User::where('api_token', $api_token)->where('domain', $domain)->first();

            if (!$user) {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'X-Access-Token không hợp lệ !',
                ], 401);
            }

            if ($user->status !== 'active') {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'Tài khoản của bạn hiện tại không được phép thực hiện hành động này !',
                ], 401);
            }

            $valid = Validator::make($request->all(), [
                'order_code' => 'required',
            ], [
                'order_code.required' => 'Vui lòng nhập mã đơn hàng cần bảo hành !',
            ]);

            if ($valid->fails()) {
                return response()->json([
                    'code' => '400',
                    'status' => 'error',
                    'message' => $valid->errors()->first(),
                ], 400);
            } else {
                $order = Order::where('order_code', $request->order_code)->where('user_id', $user->id)->where('domain', $domain)->first();
                if (!$order) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Không tìm thấy đơn hàng cần bảo hành !',
                    ], 400);
                }

                if ($order->status === 'Refunded') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã được hoàn tiền không thể bảo hành !',
                    ], 400);
                }

                

                $server = $order->server;
                if ($server) {
                    if ($server->providerName == '2mxh') {
                        $twoMXH = new TwoMxhController();
                        $twoMXH->path = $server->providerLink;
                        $result = $twoMXH->warranty($order->order_id);
                        if (isset($result) && $result['status'] === true) {
                            $order->status = 'Processing';
                            $order->save();
                            return response()->json([
                                'code' => '200',
                                'status' => 'success',
                                'message' => 'Đơn hàng của bạn đã được gửi yêu cầu bảo hành!',
                            ], 200);
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'message' => $result['message'],
                            ], 400);
                        }
                    } else {
                        


                        ###smm
                        $tran = Transaction::where('tran_code', $order->order_id)->first();

                        if ($tran) {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'message' => 'Đơn hàng đang trong quá trình bảo hành vui lòng chờ !',
                            ], 400);
                        }
                         
                        $smms = Smm::where('domain', env('APP_MAIN_SITE'))->where('name', $order->orderProviderName)->first();


                        $path = $smms->name;

                        $post = array(
                            'key' => $smms->token,
                            'action' => 'refill',

                            'order' => $order->order_id

                        );
                        $result = curl_smm($path, $post);
                        if (isset($result['refill']) && !empty($result['refill'])) {


                            $transaction = new Transaction();
                            $transaction->user_id = $user->id;
                            $transaction->tran_code = $order->order_id;
                            $transaction->type = 'refund';
                            $transaction->action = 'sub';
                            $transaction->first_balance = 0;
                            $transaction->before_balance = $user->balance;
                            $transaction->after_balance = $user->balance - 0;
                            $transaction->note = 'Thực hiện thao tác bảo hành mã đơn ' . $order->order_code;
                            $transaction->ip = $request->ip();
                            $transaction->domain = $domain;
                            $transaction->save();

                         
                            $user->save();
                            return response()->json([
                                'code' => '200',
                                'status' => 'success',
                                'message' => 'Đơn hàng của bạn đã được gửi yêu cầu bảo hành!',
                            ], 200);


                        } else {


                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'message' => 'Đơn hàng này không hỗ trợ bảo hành, trân trọng!',
                            ], 400);
                        }
                    }
                } else {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Không tìm thấy máy chủ của đơn hàng này !',
                    ], 400);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => '500',
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateOrder(Request $request)
    {
        try {
            $api_token = $request->header('X-Access-Token');

            if (!$api_token) {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'Không tìm thấy X-Access-Token !',
                ], 401);
            }

            $domain = $request->getHost();
            $user = User::where('api_token', $api_token)->where('domain', $domain)->first();

            if (!$user) {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'X-Access-Token không hợp lệ !',
                ], 401);
            }

            if ($user->status !== 'active') {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'Tài khoản của bạn hiện tại không được phép thực hiện hành động này !',
                ], 401);
            }

            $valid = Validator::make($request->all(), [
                'order_code' => 'required',
            ], [
                'order_code.required' => 'Vui lòng nhập mã đơn hàng cần cập nhật !',
            ]);

            if ($valid->fails()) {
                return response()->json([
                    'code' => '400',
                    'status' => 'error',
                    'message' => $valid->errors()->first(),
                ], 400);
            } else {
                $order = Order::where('order_code', $request->order_code)->where('user_id', $user->id)->where('domain', $domain)->first();
                if (!$order) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Không tìm thấy đơn hàng cần cập nhật !',
                    ], 400);
                }

                if ($order->status === 'Completed') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã hoàn thành không thể cập nhật !',
                    ], 400);
                }

                if ($order->status === 'Cancelled') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã bị hủy không thể cập nhật !',
                    ], 400);
                }

                if ($order->status === 'Failed') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã thất bại không thể cập nhật !',
                    ], 400);
                }

                if ($order->status === 'Refunded') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã được hoàn tiền không thể cập nhật !',
                    ], 400);
                }

                if ($order->status === 'WaitingForRefund') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đang chờ hoàn tiền không thể cập nhật !',
                    ], 400);
                }

                if ($order->status === 'Partially Refunded') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã được hoàn tiền một phần không thể cập nhật !',
                    ], 400);
                }

                if ($order->status === 'Partially Completed') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã hoàn thành một phần không thể cập nhật !',
                    ], 400);
                }

                $server = $order->server;
                if ($server) {
                    if ($server->providerName == '2mxh') {
                        $twoMXH = new TwoMxhController();
                        $twoMXH->path = $server->providerLink;
                        $result = $twoMXH->orderUpdate($order->order_id);
                        if (isset($result) && $result['status'] === true) {
                            $data = $result['data'];
                            $start_number = $data['start_number'];
                            $success_count = $data['success_count'];
                            $status = $data['status'];
                            $id = $data['id'];
                            switch ($status) {
                                case 'Running':
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = 'Running';
                                    break;
                                case 'Completed':
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = 'Completed';
                                    break;
                                case 'Canceled':
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = 'Cancelled';
                                    break;
                                case 'Failed':
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = 'Failed';
                                    break;
                                case 'Paused':
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = 'Cancelled';
                                    break;
                                case 'Error':
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = 'Failed';
                                    break;
                                case 'WaitingForRefund':
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = 'Cancelled';
                                    break;
                                case 'Refund':
                                    $orderData = json_decode($order->order_data);
                                    $quantity = $orderData->quantity;
                                    $price = $orderData->price;

                                    if ($quantity > $success_count) {
                                        $returned = $quantity - $success_count;
                                    } else {
                                        $returned = $quantity;
                                    }

                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = 'Refunded';

                                    $tranCode = 'R_' . time() . rand(1000, 9999);
                                    Transaction::create([
                                        'user_id' => $order->user_id,
                                        'tran_code' => $tranCode,
                                        'type' => 'refund',
                                        'action' => 'add',
                                        'first_balance' => $returned,
                                        'before_balance' => $order->user->balance,
                                        'after_balance' => $order->user->balance + ceil($returned * $price),
                                        'note' => 'Hoàn tiền đơn hàng #' . $order->order_code,
                                        'ip' => $request->ip(),
                                        'domain' => $order->domain,
                                    ]);

                                    $order->user->balance += ceil($returned * $price);
                                    $order->user->save();

                                    if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                                        $bot_notify = new TelegramSdk();
                                        $bot_notify->botNotify()->sendMessage([
                                            'chat_id' => siteValue('telegram_chat_id'),
                                            'text' => "Đơn hàng <b>#{$order->order_code}</b> đã được hoàn tiền với số lượng <b>{$returned}</b> tương ứng <b>" . number_format(ceil($returned * $price)) . "đ</b>",
                                            'parse_mode' => 'HTML',
                                        ]);
                                    }
                                    break;
                                default:
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = 'Running';
                                    break;
                            }
                            $order->save();
                            return response()->json([
                                'code' => '200',
                                'status' => 'success',
                                'message' => "Cập nhật đơn thành công",
                            ], 400);
                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'message' => $result['message'],
                            ], 400);
                        }
                    } else if ($order->orderProviderName == 'traodoisub') {



                        $tds = new TraodoisubController();

                        $tds->path = $order['orderProviderPath'];
                        $result = $tds->order($order['order_code']);

                        if (isset($result['status']) && $result['status'] == true) {
                            if (isset($result['data']['data'])) {
                                foreach ($result['data']['data'] as $data) {
                                    if (isset($data['note']) && $data['note'] == $order['order_code']) {



                                        $code_order = $data['note'];
                                        $status = $data['status'];

                                        if (isset($data['start'])) {

                                            $start = $data['start'];
                                        } else {
                                            $start = 0;
                                        }
                                        $item = json_decode($order->order_data);
                                        $buff = $item->quantity - ($data['sl'] - $data['datang']);
                                        $order = Order::where('order_code', $code_order)->first();
                                        if ($order) {
                                            switch ($status) {
                                                case '<span class="badge badge badge-soft-success">Đang Chạy</span>':
                                                    $order->start = $start;
                                                    $order->buff = $buff;
                                                    $order->status = 'Running';
                                                    break;
                                                case '<span class="badge badge badge-soft-primary">Hoàn Thành</span>':
                                                    $order->start = $start;
                                                    $order->buff = $buff;
                                                    $order->status = 'Completed';
                                                    break;
                                                case 'Report':
                                                    $order->start = $start;
                                                    $order->buff = $buff;
                                                    $order->status = 'Failed';
                                                    break;
                                                case '<span class="badge badge badge-soft-warning">Tạm dừng</span>':
                                                    $order->start = $start;
                                                    $order->buff = $buff;
                                                    $order->status = 'Holding';
                                                    break;
                                                case 'Error':
                                                    $order->start = $start;
                                                    $order->buff = $buff;
                                                    $order->status = 'Failed';
                                                    break;
                                                case 'Refund':
                                                    $order->start = $start;
                                                    $order->buff = $buff;
                                                    $order->status = 'Refunded';

                                                    break;
                                                default:
                                                    $order->start = $start;
                                                    $order->buff = $buff;
                                                    $order->status = 'Running';
                                                    break;
                                            }
                                            $order->save();
                                            return response()->json([
                                                'code' => '200',
                                                'status' => 'success',
                                                'message' => 'Đơn hàng của bạn đã được cập nhật thành công !',
                                            ], 200);
                                        }
                                    }
                                }
                            }


                        } else {
                            return response()->json([
                                'code' => '400',
                                'status' => 'error',
                                'message' => $result['message'],
                            ], 400);
                        }
                    } else {
                        //  cập nhật thành công
                        return response()->json([
                            'code' => '200',
                            'status' => 'success',
                            'message' => 'Đơn hàng của bạn đã được cập nhật thành công !',
                        ], 200);
                    }
                } else {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Không tìm thấy máy chủ của đơn hàng này !',
                    ], 400);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => '500',
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function renewOrder(Request $request)
    {
        try {
            $api_token = $request->header('X-Access-Token');

            if (!$api_token) {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'Không tìm thấy X-Access-Token !',
                ], 401);
            }

            $domain = $request->getHost();
            $user = User::where('api_token', $api_token)->where('domain', $domain)->first();

            if (!$user) {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'X-Access-Token không hợp lệ !',
                ], 401);
            }

            if ($user->status !== 'active') {
                return response()->json([
                    'code' => '401',
                    'status' => 'error',
                    'message' => 'Tài khoản của bạn hiện tại không được phép thực hiện hành động này !',
                ], 401);
            }

            $valid = Validator::make($request->all(), [
                'order_code' => 'required',
                'days' => 'required|numeric|min:1'
            ], [
                'order_code.required' => 'Vui lòng nhập mã đơn hàng cần cập nhật !',
                'days.required' => 'Vui lòng nhập số ngày gia hạn !',
                'days.numeric' => 'Số ngày gia hạn phải là số !',
            ]);

            if ($valid->fails()) {
                return response()->json([
                    'code' => '400',
                    'status' => 'error',
                    'message' => $valid->errors()->first(),
                ], 400);
            } else {
                $order = Order::where('order_code', $request->order_code)->where('user_id', $user->id)->where('domain', $domain)->first();
                if (!$order) {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Không tìm thấy đơn hàng cần cập nhật !',
                    ], 400);
                }

                if ($order->status === 'Cancelled') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã bị hủy không thể gia hạn !',
                    ], 400);
                }

                if ($order->status === 'Failed') {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Đơn hàng này đã thất bại không thể gia hạn !',
                    ], 400);
                }

                $server = $order->server;
                if ($server) {

                    $price = $order->price;
                    $payment = $order->payment;
                    $quantity = $order->orderdata()['quantity'];
                    $duration = $order->orderdata()['duration'];
                    $posts = $order->orderdata()['posts'] === 'unlimited' ? 1 : $order->orderdata()['posts'];
                    $total = $price * $request->days * $quantity * $posts;

                    if ($user->balance < ceil($total)) {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => 'Số dư của bạn không đủ để thực hiện giao dịch này !',
                        ], 400);
                    }

                    $orderdata = json_decode($order->order_data);
                    $orderdata->posts = $orderdata->posts === 'unlimited' ? 1 : $orderdata->posts;
                    $orderdata->payment = $orderdata->payment + ceil($total);
                    $order->order_data = json_encode($orderdata);
                    $order->status = 'Processing';
                    $order->payment = ceil($total);
                    $order->remaining = $order->remaining + $request->days;
                    $order->time = now();
                    $order->save();

                    $tranCode = 'R_' . time() . rand(1000, 9999);
                    Transaction::create([
                        'user_id' => $order->user_id,
                        'tran_code' => $tranCode,
                        'type' => 'renew',
                        'action' => 'sub',
                        'first_balance' => ceil($total),
                        'before_balance' => $order->user->balance,
                        'after_balance' => $order->user->balance - ceil($total),
                        'note' => 'Gia hạn đơn hàng #' . $order->order_code,
                        'ip' => $request->ip(),
                        'domain' => $order->domain,
                    ]);

                    $order->user->balance -= ceil($total);
                    $order->user->save();

                    if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                        $bot_notify = new TelegramSdk();
                        $bot_notify->botNotify()->sendMessage([
                            'chat_id' => siteValue('telegram_chat_id'),
                            'text' => "Đơn hàng <b>#{$order->order_code}</b> đã được gia hạn thêm <b>{$request->days}</b> ngày với giá <b>" . number_format(ceil($total)) . "đ</b>",
                            'parse_mode' => 'HTML',
                        ]);
                    }

                    return response()->json([
                        'code' => '200',
                        'status' => 'success',
                        'message' => 'Đơn hàng của bạn đã được gia hạn thành công !',
                    ], 200);
                } else {
                    return response()->json([
                        'code' => '400',
                        'status' => 'error',
                        'message' => 'Không tìm thấy máy chủ của đơn hàng này !',
                    ], 400);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => '500',
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
