<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Api\Service\BaostarController;
use App\Http\Controllers\Api\Service\BoosterviewsController;
use App\Http\Controllers\Api\Service\CheoTuongTacController;
use App\Http\Controllers\Api\Service\CongLikeController;
use App\Http\Controllers\Api\Service\Hacklike17Controller;
use App\Http\Controllers\Api\Service\TuongtaccheoController;
use App\Http\Controllers\Api\Service\SmmKingController;
use App\Http\Controllers\Api\Service\SubgiareController;
use App\Http\Controllers\Api\Service\TraodoisubController;
use App\Http\Controllers\Api\Service\TuongTacSaleController;
use App\Http\Controllers\Api\Service\TwoMxhController;
use App\Http\Controllers\Api\Service\TanglikeautoController;

use App\Http\Controllers\Controller;
use App\Library\TelegramSdk;
use App\Models\Order;
use App\Models\Smm;
use App\Models\ServerAction;
use App\Models\Service;
use App\Models\ServiceServer;
use App\Models\ServicePlatform;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderVController extends Controller
{
    public function createOrder(Request $request)
    {
        try {
            $api_token = $request->header("X-Access-Token");

            if (!$api_token) {
                return response()->json(
                    [
                        "code" => "401",
                        "status" => "error",
                        "message" => "Không tìm thấy X-Access-Token !",
                    ],
                    401
                );
            }

            $domain = $request->getHost();
            $user = User::where("api_token", $api_token)
                ->where("domain", $domain)
                ->first();

            if (!$user) {
                return response()->json(
                    [
                        "code" => "401",
                        "status" => "error",
                        "message" => "X-Access-Token không hợp lệ !",
                    ],
                    401
                );
            }

            if ($user->status !== "active") {
                return response()->json(
                    [
                        "code" => "401",
                        "status" => "error",
                        "message" =>
                            "Tài khoản của bạn hiện tại không được phép thực hiện hành động này !",
                    ],
                    401
                );
            }

            $chuoi = $request->massorder;
            $cac_dong = explode("\n", $chuoi);
            $ket_qua = [];
            foreach ($cac_dong as $dong) {
                $phan_tu = array_map("trim", explode("|", $dong));

                $ket_qua[] = $phan_tu;
            }

            if ($domain === env("APP_MAIN_SITE")) {
                foreach ($ket_qua as $mang_con) {
                    if (
                        isset($mang_con[0]) &&
                        isset($mang_con[1]) &&
                        isset($mang_con[2])
                    ) {
                        $id = $mang_con[0]; // ID sản phẩm
                        $link = $mang_con[1]; // Link sản phẩm
                        $soluong = $mang_con[2]; // Số lượng sản phẩm

                        $server = ServiceServer::where("id", $id)
                            ->where("domain", $domain)
                            ->first();
                        $service = Service::where("id", $server->service_id)
                            ->where("domain", env("APP_MAIN_SITE"))
                            ->first();
                        $service_platform = ServicePlatform::where(
                            "id",
                            $service->platform_id
                        )->first();
                        if (!$service) {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" => "Gói cần mua không tồn tại !",
                                ],
                                400
                            );
                        }

                        if ($service->status !== "active") {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" =>
                                        "Gói cần mua hiện không khả dụng !",
                                ],
                                400
                            );
                        }
                        if (!$server) {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" => "Máy chủ này không tồn tại !",
                                ],
                                400
                            );
                        }

                        if ($server->visibility !== "public") {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" => "Máy chủ này không khả dụng !",
                                ],
                                400
                            );
                        }

                        if ($server->status !== "active") {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" =>
                                        "Máy chủ này hiện đang bảo trì !",
                                ],
                                400
                            );
                        }

                        $serverAction = ServerAction::where(
                            "server_id",
                            $server->id
                        )->first();

                        if (!$serverAction) {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" =>
                                        "Máy chủ này hiện đang bị lỗi vui lòng thử lại sau !",
                                ],
                                400
                            );
                        }

                        if ($serverAction->quantity_status === "on") {
                            if (!is_numeric($soluong)) {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" =>
                                            "Trường số lượng phải là một số",
                                    ],
                                    400
                                );
                            }
                        }

                        if ($serverAction->reaction_status === "on") {
                            $valid = Validator::make(
                                $request->all(),
                                [
                                    "reaction" => "required",
                                ],
                                [
                                    "reaction.required" => "Vui lòng cảm xúc !",
                                ]
                            );

                            if ($valid->fails()) {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $valid->errors()->first(),
                                    ],
                                    400
                                );
                            }
                        }

                        if ($serverAction->comments_status === "on") {
                            $valid = Validator::make(
                                $request->all(),
                                [
                                    "comments" => "required",
                                ],
                                [
                                    "comments.required" =>
                                        "Vui lòng nhập nội dung bình luận !",
                                ]
                            );

                            if ($valid->fails()) {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $valid->errors()->first(),
                                    ],
                                    400
                                );
                            }

                            $count = 0;
                            $comments = explode("\n", "");
                            $comments = array_filter($comments, "trim");
                            $comments = array_values($comments);
                            $count = count($comments);
                            $request->merge(["quantity" => $count]);
                        }

                        if ($serverAction->minutes_status === "on") {
                            $valid = Validator::make(
                                $request->all(),
                                [
                                    "minutes" => "required|integer",
                                ],
                                [
                                    "minutes.required" =>
                                        "Vui lòng chọn Số Phút cần mua !",
                                    "minutes.integer" =>
                                        "Số Phút cần mua phải là số !",
                                ]
                            );

                            if ($valid->fails()) {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $valid->errors()->first(),
                                    ],
                                    400
                                );
                            }
                        }

                        if ($serverAction->posts_status === "on") {
                            $valid = Validator::make(
                                $request->all(),
                                [
                                    "posts" => "required",
                                ],
                                [
                                    "posts.required" =>
                                        "Vui lòng chọn số bài viết cần mua !",
                                ]
                            );

                            if ($valid->fails()) {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $valid->errors()->first(),
                                    ],
                                    400
                                );
                            }

                            $newPost =
                                "unlimited" == "unlimited" ? 1 : "unlimited";
                            $request->merge(["posts" => $newPost]);
                        }

                        if ($serverAction->time_status === "on") {
                            $valid = Validator::make(
                                $request->all(),
                                [
                                    "duration" => "required|integer",
                                ],
                                [
                                    "duration.required" =>
                                        "Vui lòng chọn số bài viết cần mua !",
                                    "duration.integer" =>
                                        "Số bài viết cần mua phải là số !",
                                ]
                            );

                            if ($valid->fails()) {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $valid->errors()->first(),
                                    ],
                                    400
                                );
                            }
                        }

                        if ($server->limit_day !== 0) {
                            $orderToday = Order::where("server_id", $server->id)
                                ->whereDate("created_at", Carbon::today())
                                ->count();

                            if ($orderToday >= $soluong) {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" =>
                                            "Máy chủ này đã đạt giới hạn mua hàng trong ngày !",
                                    ],
                                    400
                                );
                            }
                        }

                        if ($soluong < $server->min) {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" =>
                                        "Số lượng cần mua phải lớn hơn hoặc bằng " .
                                        $server->min .
                                        " !",
                                ],
                                400
                            );
                        }

                        if ($soluong > $server->max) {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" =>
                                        "Số lượng cần mua phải nhỏ hơn hoặc bằng " .
                                        $server->max .
                                        " !",
                                ],
                                400
                            );
                        }

                        $price = $server->levelPrice($user->level);

                        if ($serverAction->time_status === "on") {
                            $total = $price * $soluong * 30;
                        } elseif ($serverAction->posts_status === "on") {
                            $posts = "unlimited";
                            $total = $price * $soluong * $posts;
                        } elseif (
                            $serverAction->time_status === "on" &&
                            $serverAction->posts_status === "on"
                        ) {
                            $posts = "unlimited";
                            $total = $price * $soluong * 30 * $posts;
                        } else {
                            $total = $price * $soluong;
                        }

                        if ($user->balance < ceil($total)) {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" =>
                                        "Số dư của bạn không đủ để thực hiện giao dịch này !",
                                ],
                                400
                            );
                        }

                        if ($server->providerName == "trumsubre") {
                            $sgr = new SubgiareController();
                            $sgr->path = $server->providerLink;
                            $sgr->data = [
                                "object_id" => $link,
                                "server_order" => $server->providerServer,
                                "quantity" => $soluong,
                                "reaction" => "",
                                "speed" => "fast",
                                "comment" => "",
                                "minutes" => "",
                                "time" => "",
                                "days" => 30,
                                "post" => "unlimited",
                            ];

                            $result = $sgr->createOrder();
                            if (isset($result) && $result["status"] === true) {
                                $orderID = $result["data"]["code_order"];
                                $orderCode =
                                    site("madon") .
                                    "_" .
                                    time() .
                                    rand(1000, 9999);

                                $orderData = [
                                    "user_id" => $user->id,
                                    "service_id" => $service->id,
                                    "server_id" => $server->id,
                                    "order_code" => $orderCode,
                                    "object_id" => $link,
                                    "quantity" => $soluong,
                                    "reaction" => "",
                                    "comments" => htmlentities(""),
                                    "minutes" => "",
                                    "posts" => "unlimited",
                                    "duration" => 30,
                                    "price" => $price,
                                    "payment" => $total,
                                    "note" => "Đơn SLL",
                                ];
                            } else {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $result["message"],
                                    ],
                                    400
                                );
                            }
                        } elseif ($server->providerName == "tanglikeauto") {
                            $tanglike = new TanglikeautoController();
                            $tanglike->path = $server->providerLink;
                            $tanglike->data = [
                                "object_id" => $link,
                                "server_order" => $server->providerServer,
                                "quantity" => $soluong,
                                "reaction" => "",
                                "speed" => "fast",
                                "comment" => "",
                                "minutes" => "",
                                "time" => "",
                                "days" => 30,
                                "post" => "unlimited",
                            ];

                            $result = $tanglike->createOrder();

                            if (
                                isset($result["status"]) &&
                                $result["status"] === "success"
                            ) {
                                $orderID = $result["order_id"];
                                $orderCode =
                                    site("madon") .
                                    "_" .
                                    time() .
                                    rand(1000, 9999);

                                $orderData = [
                                    "user_id" => $user->id,
                                    "service_id" => $service->id,
                                    "server_id" => $server->id,
                                    "order_code" => $orderCode,
                                    "object_id" => $link,
                                    "quantity" => $soluong,
                                    "reaction" => "",
                                    "comments" => htmlentities(""),
                                    "minutes" => "",
                                    "posts" => "unlimited",
                                    "duration" => 30,
                                    "price" => $price,
                                    "payment" => $total,
                                    "note" => "Đơn SLL",
                                ];
                            } else {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => "Vui lòng liên hệ admin",
                                    ],
                                    400
                                );
                            }
                        } elseif ($server->providerName == "tuongtaccheo") {
                            $orderCode =
                                site("madon") . "_" . time() . rand(1000, 9999);
                            $tds = new TuongtaccheoController();
                            $tds->path = $server->providerLink;
                            $tds->data = [
                                "object_id" => $link,
                                "server_order" => $server->providerServer,
                                "quantity" => $soluong,
                                "reaction" => "LIKE",
                                "speed" => 1,
                                "comment" => "",

                                "minutes" => "",

                                "days" => "",
                                "post" => "",
                            ];

                            $result = $tds->createOrder();
                            if (
                                isset($result["status"]) &&
                                $result["status"] === true
                            ) {
                                $orderID = $result["data"];

                                $orderData = [
                                    "user_id" => $user->id,
                                    "service_id" => $service->id,
                                    "server_id" => $server->id,
                                    "order_code" => $orderCode,
                                    "object_id" => $link,
                                    "quantity" => $soluong,
                                    "reaction" => "LIKE",
                                    "comments" => htmlentities(""),
                                    "minutes" => "",
                                    "posts" => "unlimited",
                                    "duration" => 30,
                                    "price" => $price,
                                    "payment" => $total,
                                    "note" => "Đơn SLL",
                                ];
                            } else {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $result["message"],
                                    ],
                                    400
                                );
                            }
                        } elseif ($server->providerName == "traodoisub") {
                            $orderCode =
                                site("madon") . "_" . time() . rand(1000, 9999);
                            $tds = new TraodoisubController();
                            $tds->path = $server->providerLink;
                            $tds->data = [
                                "object_id" => $link,
                                "server_order" => $server->providerServer,
                                "quantity" => $soluong,
                                "reaction" => "",
                                "speed" => 1,
                                "comment" => "",
                                "order_codes" => $orderCode,
                                "minutes" => "",
                                "time" => "",
                                "days" => 30,
                                "post" => "unlimited",
                            ];

                            $result = $tds->createOrder();
                            if (
                                isset($result["status"]) &&
                                $result["status"] === true
                            ) {
                                $orderID = $result["data"];

                                $orderData = [
                                    "user_id" => $user->id,
                                    "service_id" => $service->id,
                                    "server_id" => $server->id,
                                    "order_code" => $orderCode,
                                    "object_id" => $link,
                                    "quantity" => $soluong,
                                    "reaction" => "",
                                    "comments" => htmlentities(""),
                                    "minutes" => "",
                                    "posts" => "unlimited",
                                    "duration" => 30,
                                    "price" => $price,
                                    "payment" => $total,
                                    "note" => "Đơn SLL",
                                ];
                            } else {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => "Vui lòng liên hệ admin",
                                    ],
                                    400
                                );
                            }
                        } elseif ($server->providerName == "2mxh") {
                            $twoMXH = new TwoMxhController();
                            $twoMXH->path = $server->providerLink;
                            $twoMXH->data = [
                                "object_id" => $link,
                                "quantity" => $soluong,
                                "reaction" => "",
                                "comment" => "",
                                "minutes" => "",
                                "time" => "",
                                "duration" => 30,
                                "post" => "unlimited",
                                "server_order" => $server->providerServer,
                            ];

                            $result = $twoMXH->CreateOrder();
                            if (isset($result) && $result["status"] == true) {
                                $orderID = $result["data"]["order"]["order_id"];
                                $orderCode =
                                    site("madon") .
                                    "_" .
                                    time() .
                                    rand(1000, 9999);

                                $orderData = [
                                    "user_id" => $user->id,
                                    "service_id" => $service->id,
                                    "server_id" => $server->id,
                                    "order_code" => $orderCode,
                                    "object_id" => $link,
                                    "quantity" => $soluong,
                                    "reaction" => "",
                                    "comments" => htmlentities(""),
                                    "minutes" => "",
                                    "posts" => "unlimited",
                                    "duration" => 30,
                                    "price" => $price,
                                    "payment" => $total,
                                    "note" => "Đơn SLL",
                                ];
                            } else {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $result["message"],
                                    ],
                                    400
                                );
                            }
                        } elseif ($server->providerName == "baostar") {
                            $baoStar = new BaostarController();
                            $baoStar->path = $server->providerLink;
                            $baoStar->data = [
                                "object_id" => $link,
                                "quantity" => $soluong,
                                "object_type" => "",
                                "package_name" => $server->providerServer,
                                "list_message" => "",
                                "num_minutes" => "",
                                "num_day" => 30,
                                "slbv" => "unlimited",
                            ];

                            $result = $baoStar->createOrder();
                            if (isset($result) && $result["status"] == true) {
                                $orderID = $result["data"]["code_order"];
                                $orderCode =
                                    site("madon") .
                                    "_" .
                                    time() .
                                    rand(1000, 9999);

                                $orderData = [
                                    "user_id" => $user->id,
                                    "service_id" => $service->id,
                                    "server_id" => $server->id,
                                    "order_code" => $orderCode,
                                    "object_id" => $link,
                                    "quantity" => $soluong,
                                    "reaction" => "",
                                    "comments" => htmlentities(""),
                                    "minutes" => "",
                                    "posts" => "unlimited",
                                    "duration" => 30,
                                    "price" => $price,
                                    "payment" => $total,
                                    "note" => "Đơn SLL",
                                ];
                            } else {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $result["message"],
                                    ],
                                    400
                                );
                            }
                        } elseif ($server->providerName == "boosterviews") {
                            $boosterviews = new BoosterviewsController();

                            $result = $boosterviews->order([
                                "service" => $server->providerServer,
                                "link" => $link,
                                "quantity" => $soluong,
                                "comments" => "",
                            ]);

                            if (isset($result) && $result["order"]) {
                                $orderID = $result["order"];
                                $orderCode =
                                    site("madon") .
                                    "_" .
                                    time() .
                                    rand(1000, 9999);

                                $orderData = [
                                    "user_id" => $user->id,
                                    "service_id" => $service->id,
                                    "server_id" => $server->id,
                                    "order_code" => $orderCode,
                                    "object_id" => $link,
                                    "quantity" => $soluong,
                                    "reaction" => "",
                                    "comments" => htmlentities(""),
                                    "minutes" => "",
                                    "posts" => "unlimited",
                                    "duration" => 30,
                                    "price" => $price,
                                    "payment" => $total,
                                    "note" => "Đơn SLL",
                                ];
                            } else {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $result["message"],
                                    ],
                                    400
                                );
                            }
                        } elseif ($server->providerName == "cheotuongtac") {
                            $cheotuongtac = new CheoTuongTacController();

                            $result = $cheotuongtac->order([
                                "service" => $server->providerServer,
                                "link" => $link,
                                "quantity" => $soluong,
                                "comments" => "",
                            ]);

                            if (isset($result) && $result["order"]) {
                                $orderID = $result["order"];
                                $orderCode =
                                    site("madon") .
                                    "_" .
                                    time() .
                                    rand(1000, 9999);

                                $orderData = [
                                    "user_id" => $user->id,
                                    "service_id" => $service->id,
                                    "server_id" => $server->id,
                                    "order_code" => $orderCode,
                                    "object_id" => $link,
                                    "quantity" => $soluong,
                                    "reaction" => "",
                                    "comments" => htmlentities(""),
                                    "minutes" => "",
                                    "posts" => "unlimited",
                                    "duration" => 30,
                                    "price" => $price,
                                    "payment" => $total,
                                    "note" => "Đơn SLL",
                                ];
                            } else {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $result["message"],
                                    ],
                                    400
                                );
                            }
                        } elseif ($server->providerName == "smmking") {
                            $smmking = new SmmKingController();

                            $result = $smmking->order([
                                "service" => $server->providerServer,
                                "link" => $link,
                                "quantity" => $soluong,
                                "comments" => "",
                            ]);

                            if (
                                isset($result["order"]) &&
                                !empty($result["order"])
                            ) {
                                $orderID = $result["order"];
                                $orderCode =
                                    site("madon") .
                                    "_" .
                                    time() .
                                    rand(1000, 9999);

                                $orderData = [
                                    "user_id" => $user->id,
                                    "service_id" => $service->id,
                                    "server_id" => $server->id,
                                    "order_code" => $orderCode,
                                    "object_id" => $link,
                                    "quantity" => $soluong,
                                    "reaction" => "",
                                    "comments" => htmlentities(""),
                                    "minutes" => "",
                                    "posts" => "unlimited",
                                    "duration" => 30,
                                    "price" => $price,
                                    "payment" => $total,
                                    "note" => "Đơn SLL",
                                ];
                            } else {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" =>
                                            $result["error"] ??
                                            ($result["message"] ??
                                                ($result["msg"] ??
                                                    ($result["status"] ??
                                                        "Vui lòng thử lại sau"))),
                                    ],
                                    400
                                );
                            }
                        } elseif ($server->providerName == "tuongtacsale") {
                            $tuongtacsale = new TuongTacSaleController();

                            $result = $tuongtacsale->order([
                                "service" => $server->providerServer,
                                "link" => $link,
                                "quantity" => $soluong,
                                "comments" => "",
                            ]);

                            if (isset($result) && $result["order"]) {
                                $orderID = $result["order"];
                                $orderCode =
                                    site("madon") .
                                    "_" .
                                    time() .
                                    rand(1000, 9999);

                                $orderData = [
                                    "user_id" => $user->id,
                                    "service_id" => $service->id,
                                    "server_id" => $server->id,
                                    "order_code" => $orderCode,
                                    "object_id" => $link,
                                    "quantity" => $soluong,
                                    "reaction" => "",
                                    "comments" => htmlentities(""),
                                    "minutes" => "",
                                    "posts" => "unlimited",
                                    "duration" => 30,
                                    "price" => $price,
                                    "payment" => $total,
                                    "note" => "Đơn SLL",
                                ];
                            } else {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $result["message"],
                                    ],
                                    400
                                );
                            }
                        } elseif ($server->providerName == "hacklike17") {
                            $hacklike17 = new Hacklike17Controller();
                            $hacklike17->data = [
                                "uid" => $link,
                                "count" => $soluong,
                                "server" => $server->providerServer,
                                "reaction" => "",
                                "list_comment" => "",
                                "comments" => "",
                                "minutes" => "",
                                "days" => 30,
                            ];

                            $result = $hacklike17->order($server->providerLink);
                            if (isset($result) && $result["status"] == 1) {
                                $orderID = $result["order_id"];
                                $orderCode =
                                    site("madon") .
                                    "_" .
                                    time() .
                                    rand(1000, 9999);

                                $orderData = [
                                    "user_id" => $user->id,
                                    "service_id" => $service->id,
                                    "server_id" => $server->id,
                                    "order_code" => $orderCode,
                                    "object_id" => $link,
                                    "quantity" => $soluong,
                                    "reaction" => "",
                                    "comments" => htmlentities(""),
                                    "minutes" => "",
                                    "posts" => "unlimited",
                                    "duration" => 30,
                                    "price" => $price,
                                    "payment" => $total,
                                    "note" => "Đơn SLL",
                                ];
                            } else {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $result["msg"],
                                    ],
                                    400
                                );
                            }
                        } elseif ($server->providerName == "conglike") {
                            $conglike = new CongLikeController();
                            $conglike->data = [
                                "post_id" => $link,
                                "page_id" => $link,
                                "soluong" => $soluong,
                                "num_package" => 30,
                                "package_id" => $server->providerServer,
                            ];
                            $result = $conglike->order($server->providerLink);
                            if (isset($result) && $result["code"] == 100) {
                                $orderID = $link;
                                $orderCode =
                                    site("madon") .
                                    "_" .
                                    time() .
                                    rand(1000, 9999);

                                $orderData = [
                                    "user_id" => $user->id,
                                    "service_id" => $service->id,
                                    "server_id" => $server->id,
                                    "order_code" => $orderCode,
                                    "object_id" => $link,
                                    "quantity" => $soluong,
                                    "reaction" => "",
                                    "comments" => htmlentities(""),
                                    "minutes" => "",
                                    "posts" => "unlimited",
                                    "duration" => 30,
                                    "price" => $price,
                                    "payment" => $total,
                                    "note" => "Đơn SLL",
                                ];
                            } else {
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" => $result["message"],
                                    ],
                                    400
                                );
                            }
                        } elseif ($server->providerName == "dontay") {
                            $orderID = time() . rand(1000, 9999);
                            $orderCode =
                                site("madon") . "_" . time() . rand(1000, 9999);

                            $orderData = [
                                "user_id" => $user->id,
                                "service_id" => $service->id,
                                "server_id" => $server->id,
                                "order_code" => $orderCode,
                                "object_id" => $link,
                                "quantity" => $soluong,
                                "reaction" => "",
                                "comments" => htmlentities(""),
                                "minutes" => "",
                                "posts" => "unlimited",
                                "duration" => 30,
                                "price" => $price,
                                "payment" => $total,
                                "note" => "Đơn SLL",
                            ];
                        } else {
                            $smm = Smm::where(
                                "domain",
                                env("APP_MAIN_SITE")
                            )->get();
                            foreach ($smm as $smms) {
                                if ($server->providerName == $smms["name"]) {
                                    $path = $smms["name"];

                                    $post = [
                                        "key" => $smms["token"],
                                        "action" => "add",

                                        "service" => $server->providerServer,
                                        "link" => $link,
                                        "minutes" => "",
                                        "quantity" => $soluong,
                                        "comments" => "",
                                        "reaction" => strtolower("") ?? "like",
                                    ];
                                    $result = curl_smm($path, $post);
                                    if (
                                        isset($result["order"]) &&
                                        !empty($result["order"])
                                    ) {
                                        $orderID = $result["order"];
                                        $orderCode =
                                            site("madon") .
                                            "_" .
                                            time() .
                                            rand(1000, 9999);

                                        $orderData = [
                                            "user_id" => $user->id,
                                            "service_id" => $service->id,
                                            "server_id" => $server->id,
                                            "order_code" => $orderCode,
                                            "object_id" => $link,
                                            "quantity" => $soluong,
                                            "reaction" => "",
                                            "comments" => htmlentities(""),
                                            "minutes" => "",
                                            "posts" => "unlimited",
                                            "duration" => 30,
                                            "price" => $price,
                                            "payment" => $total,
                                            "note" => "Đơn SLL",
                                        ];
                                    } else {
                                        return response()->json(
                                            [
                                                "code" => "400",
                                                "status" => "error",
                                                "message" =>
                                                    $result["error"] ??
                                                    ($result["message"] ??
                                                        ($result["msg"] ??
                                                            ($result[
                                                                "status"
                                                            ] ??
                                                                "Vui lòng thử lại sau"))),
                                            ],
                                            400
                                        );
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
                        $order->object_server = $request->provider_server;
                        $order->object_id = $link;
                        $order->order_id = $orderID;
                        $order->order_code = $orderCode;
                        $order->order_data = json_encode($orderData);
                        $order->start = 0;
                        $order->buff = 0;
                        $order->duration = 30;
                        $order->posts = 0;
                        $order->remaining = 30;
                        $order->price = $price;
                        $order->payment = $total;
                        $order->status = "Processing";
                        $order->ip = $request->ip();
                        $order->note = "Đơn SLL";
                        $order->time = now();
                        $order->domain = $domain;
                        $order->save();

                        if ($order) {
                            // nếu số dư của user nhỏ hơn total thì block user
                            if ($user->balance < $total) {
                                $user->status = "banned";
                                $user->save();
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" =>
                                            "Tài khoản của bạn đã bị khoá do thực hiện giao dịch không hợp lệ !",
                                    ],
                                    400
                                );
                            }

                            $transaction = new Transaction();
                            $transaction->user_id = $user->id;
                            $transaction->tran_code = $orderCode;
                            $transaction->type = "order";
                            $transaction->action = "sub";
                            $transaction->first_balance = $total;
                            $transaction->before_balance = $user->balance;
                            $transaction->after_balance =
                                $user->balance - $total;
                            $transaction->note =
                                "Thanh toán đơn hàng " . $orderCode;
                            $transaction->ip = $request->ip();
                            $transaction->domain = $domain;
                            $transaction->save();

                            $user->balance = $user->balance - $total;
                            $user->save();

                            if (
                                siteValue("telegram_bot_token") &&
                                siteValue("telegram_chat_id")
                            ) {
                                try {
                                    $bot_notify = new TelegramSdk();
                                    $bot_notify->botNotify()->sendMessage([
                                        "chat_id" => siteValue(
                                            "telegram_chat_id"
                                        ),
                                        "text" =>
                                            "➤ <b>" .
                                            $domain .
                                            " - Đơn hàng" .
                                            "</b>\n" .
                                            "➤ <b>Khách hàng:</b> " .
                                            $user->username .
                                            "\n" .
                                            "➤ <b>Dịch Vụ:</b> " .
                                            $service->platform->name .
                                            " ★ " .
                                            $service->name .
                                            "\n" .
                                            "➤ <b>Máy chủ:</b> " .
                                            $server->package_id .
                                            "\n" .
                                            "➤ <b>Link:</b> " .
                                            $link .
                                            "\n" .
                                            "➤ <b>Số lượng:</b> " .
                                            number_format($soluong) .
                                            "\n" .
                                            "➤ <b>Mã Đơn:</b> " .
                                            $order->order_code .
                                            "\n" .
                                            "➤ <b>Giao Dịch:</b> " .
                                            number_format(
                                                $transaction->before_balance
                                            ) .
                                            "đ" .
                                            " - " .
                                            number_format($total) .
                                            "đ" .
                                            " = " .
                                            number_format($user->balance) .
                                            "đ" .
                                            "\n" .
                                            "➤ <b>Ghi chú:</b> " .
                                            "Đơn SLL" .
                                            "\n",
                                        "parse_mode" => "HTML",
                                    ]);
                                } catch (\Exception $e) {
                                }
                            }

                            if (
                                $user->telegram_id !== null &&
                                $user->notification_telegram
                            ) {
                                $bot_notify = new TelegramSdk();
                                $bot_notify->botChat()->sendMessage([
                                    "chat_id" => $user->telegram_id,
                                    "text" =>
                                        "🛒 <b>Bạn vừa tạo đơn hàng mới từ website " .
                                        $domain .
                                        " !" .
                                        "</b>\n\n" .
                                        "📦 <b>Gói dịch vụ:</b> " .
                                        $service_platform->name .
                                        " - " .
                                        $service->name .
                                        "\n" .
                                        "🔗 <b>Link hoặc UID:</b> " .
                                        $link .
                                        "\n" .
                                        "🔢 <b>Số lượng:</b> " .
                                        number_format($soluong) .
                                        "\n" .
                                        "🔗 <b>Máy chủ:</b> " .
                                        $server->package_id .
                                        "\n" .
                                        "💰 <b>Giá tiền:</b> " .
                                        $price .
                                        "đ" .
                                        "\n" .
                                        "💵 <b>Thanh toán:</b> " .
                                        $total .
                                        "đ" .
                                        "\n" .
                                        "📝 <b>Ghi chú:</b> " .
                                        "Đơn SLL" .
                                        "\n",
                                    "parse_mode" => "HTML",
                                ]);
                            }
                            $data_lamtilo[] = [
                                "id" => $order->id,
                                "order_code" => $orderCode,
                                "price" => $price,
                                "payment" => $total,
                                "status" => "Processing",
                            ];
                        }
                    } else {
                        return response()->json(
                            [
                                "code" => "400",
                                "status" => "error",
                                "message" => "Vui lòng điền đầy đủ thông tin !",
                            ],
                            400
                        );
                    }
                }

                return response()->json(
                    [
                        "code" => "200",
                        "status" => "success",
                        "message" =>
                            "Đơn hàng của bạn đã được tạo thành công !",
                        "data" => $data_lamtilo,
                    ],
                    200
                );
            } else {
                foreach ($ket_qua as $mang_con) {
                    $id = $mang_con[0]; // ID sản phẩm
                    $link = $mang_con[1]; // Link sản phẩm
                    $soluong = $mang_con[2]; // Số lượng sản phẩm

                    $server = ServiceServer::where("id", $id)
                        ->where("domain", $domain)
                        ->first();
                    $service = Service::where("id", $server->service_id)
                        ->where("domain", env("APP_MAIN_SITE"))
                        ->first();
                    $service_platform = ServicePlatform::where(
                        "id",
                        $service->platform_id
                    )->first();
                    if (!$service) {
                        return response()->json(
                            [
                                "code" => "400",
                                "status" => "error",
                                "message" => "Gói cần mua không tồn tại !",
                            ],
                            400
                        );
                    }

                    if ($service->status !== "active") {
                        return response()->json(
                            [
                                "code" => "400",
                                "status" => "error",
                                "message" =>
                                    "Gói cần mua hiện không khả dụng !",
                            ],
                            400
                        );
                    }
                    if (!$server) {
                        return response()->json(
                            [
                                "code" => "400",
                                "status" => "error",
                                "message" => "Máy chủ này không tồn tại !",
                            ],
                            400
                        );
                    }

                    if ($server->visibility !== "public") {
                        return response()->json(
                            [
                                "code" => "400",
                                "status" => "error",
                                "message" => "Máy chủ này không khả dụng !",
                            ],
                            400
                        );
                    }

                    if ($server->status !== "active") {
                        return response()->json(
                            [
                                "code" => "400",
                                "status" => "error",
                                "message" => "Máy chủ này hiện đang bảo trì !",
                            ],
                            400
                        );
                    }

                    $validService = Validator::make(
                        $request->all(),
                        [
                            "object_id" => "required",
                        ],
                        [
                            "object_id.required" =>
                                "Vui lòng nhập UID hoặc Link cần mua !",
                        ]
                    );

                    if ($validService->fails()) {
                        return response()->json(
                            [
                                "code" => "400",
                                "status" => "error",
                                "message" => $validService->errors()->first(),
                            ],
                            400
                        );
                    }

                    $serverAction = ServerAction::where(
                        "server_id",
                        $server->id
                    )->first();

                    if (!$serverAction) {
                        return response()->json(
                            [
                                "code" => "400",
                                "status" => "error",
                                "message" =>
                                    "Máy chủ này hiện đang bị lỗi vui lòng thử lại sau !",
                            ],
                            400
                        );
                    }

                    if ($serverAction->quantity_status === "on") {
                        if (!is_numeric($soluong)) {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" => "Trường số lượng phải là số",
                                ],
                                400
                            );
                        }
                    }

                    if ($serverAction->reaction_status === "on") {
                        $valid = Validator::make(
                            $request->all(),
                            [
                                "reaction" => "required",
                            ],
                            [
                                "reaction.required" => "Vui lòng cảm xúc !",
                            ]
                        );

                        if ($valid->fails()) {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" => $valid->errors()->first(),
                                ],
                                400
                            );
                        }
                    }

                    if ($serverAction->comments_status === "on") {
                        $valid = Validator::make(
                            $request->all(),
                            [
                                "comments" => "required",
                            ],
                            [
                                "comments.required" =>
                                    "Vui lòng nhập nội dung bình luận !",
                            ]
                        );

                        if ($valid->fails()) {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" => $valid->errors()->first(),
                                ],
                                400
                            );
                        }

                        $count = 0;
                        $comments = explode("\n", "");
                        $comments = array_filter($comments, "trim");
                        $comments = array_values($comments);
                        $count = count($comments);
                        $request->merge(["quantity" => $count]);
                    }

                    if ($serverAction->minutes_status === "on") {
                        $valid = Validator::make(
                            $request->all(),
                            [
                                "minutes" => "required|integer",
                            ],
                            [
                                "minutes.required" =>
                                    "Vui lòng chọn Số Phút cần mua !",
                                "minutes.integer" =>
                                    "Số Phút cần mua phải là số !",
                            ]
                        );

                        if ($valid->fails()) {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" => $valid->errors()->first(),
                                ],
                                400
                            );
                        }
                    }

                    if ($serverAction->posts_status === "on") {
                        $valid = Validator::make(
                            $request->all(),
                            [
                                "posts" => "required",
                            ],
                            [
                                "posts.required" =>
                                    "Vui lòng chọn số bài viết cần mua !",
                            ]
                        );

                        if ($valid->fails()) {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" => $valid->errors()->first(),
                                ],
                                400
                            );
                        }
                        $newPost = "unlimited" == "unlimited" ? 1 : "unlimited";
                        $request->merge(["posts" => $newPost]);
                    }

                    if ($serverAction->time_status === "on") {
                        $valid = Validator::make(
                            $request->all(),
                            [
                                "duration" => "required|integer",
                            ],
                            [
                                "duration.required" =>
                                    "Vui lòng chọn số bài viết cần mua !",
                                "duration.integer" =>
                                    "Số bài viết cần mua phải là số !",
                            ]
                        );

                        if ($valid->fails()) {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" => $valid->errors()->first(),
                                ],
                                400
                            );
                        }
                    }

                    if ($server->limit_day !== 0) {
                        $orderToday = Order::where("server_id", $server->id)
                            ->whereDate("created_at", Carbon::today())
                            ->count();

                        if ($orderToday >= $soluong) {
                            return response()->json(
                                [
                                    "code" => "400",
                                    "status" => "error",
                                    "message" =>
                                        "Máy chủ này đã đạt giới hạn mua hàng trong ngày !",
                                ],
                                400
                            );
                        }
                    }

                    if ($soluong < $server->min) {
                        return response()->json(
                            [
                                "code" => "400",
                                "status" => "error",
                                "message" =>
                                    "Số lượng cần mua phải lớn hơn hoặc bằng " .
                                    $server->min .
                                    " !",
                            ],
                            400
                        );
                    }

                    if ($soluong > $server->max) {
                        return response()->json(
                            [
                                "code" => "400",
                                "status" => "error",
                                "message" =>
                                    "Số lượng cần mua phải nhỏ hơn hoặc bằng " .
                                    $server->max .
                                    " !",
                            ],
                            400
                        );
                    }

                    $price = $server->levelPrice($user->level);

                    if ($serverAction->time_status === "on") {
                        $total = $price * $soluong * 30;
                    } elseif ($serverAction->posts_status === "on") {
                        $posts = "unlimited";
                        $total = $price * $soluong * $posts;
                    } elseif (
                        $serverAction->time_status === "on" &&
                        $serverAction->posts_status === "on"
                    ) {
                        $posts = "unlimited";
                        $total = $price * $soluong * 30 * $posts;
                    } else {
                        $total = $price * $soluong;
                    }

                    if ($user->balance < ceil($total)) {
                        return response()->json(
                            [
                                "code" => "400",
                                "status" => "error",
                                "message" =>
                                    "Số dư của bạn không đủ để thực hiện giao dịch này !",
                            ],
                            400
                        );
                    }

                    /* if ($server->providerName == 'subgiare') {
                    $sgr = new SubgiareController();
                    $sgr->path = $server->providerLink;
                    $sgr->data = [
                        'object_id' => $link,
                        'server_order' => $server->providerServer,
                        'quantity' => $soluong,
                        'reaction' => '',
                        'speed' => 'fast',
                        'comment' => '',
                        'minutes' => '',
                        'time' => '',
                        'days' => 30,
                        'post' => 'unlimited',
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
                            "object_id" => $link,
                            "quantity" => $soluong,
                            "reaction" => '',
                            "comments" => htmlentities(''),
                            "minutes" => '',
                            "price" => $price,
                            'payment' => $total,
                            'note' => 'Đơn SLL',
                        ];
                    } else {
                        return response()->json([
                            'code' => '400',
                            'status' => 'error',
                            'message' => $result['message'],
                        ], 400);
                    }
                }  */

                    $admin = User::where(
                        "username",
                        site("admin_username")
                    )->first();
                    if (!$admin) {
                        return response()->json(
                            [
                                "code" => "400",
                                "status" => "error",
                                "message" => "Không tìm thấy tài khoản admin !",
                            ],
                            400
                        );
                    }

                    $urlOrder =
                        "http://" .
                        env("APP_MAIN_SITE") .
                        "/api/v1/start/create/order";

                    $dataSend = [
                        "provider_package" => $request->provider_package,
                        "provider_server" => $request->provider_server,
                        "object_id" => $link,
                        "quantity" => $soluong,
                        "reaction" => "",
                        "comments" => "",
                        "minutes" => "",
                        "posts" => "unlimited",
                        "duration" => 30,
                        "note" =>
                            $request->getHost() . " - Khởi tạo đơn hàng từ API",
                    ];

                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => $urlOrder,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => json_encode($dataSend),
                        CURLOPT_HTTPHEADER => [
                            "X-Access-Token: " . $admin->api_token,
                            "Content-Type: application/json",
                        ],
                    ]);

                    $response = curl_exec($curl);

                    curl_close($curl);
                    $result = json_decode($response, true);
                    if (isset($result) && $result["status"] == "success") {
                        $orderID = $result["data"]["id"];
                        $orderCode = "I_" . time() . rand(1000, 9999);

                        $orderData = [
                            "user_id" => $user->id,
                            "service_id" => $service->id,
                            "server_id" => $server->id,
                            "order_code" => $orderCode,
                            "object_id" => $link,
                            "quantity" => $soluong,
                            "reaction" => "",
                            "comments" => htmlentities(""),
                            "minutes" => "",
                            "price" => $price,
                            "payment" => $total,
                            "note" => "Đơn SLL",
                        ];

                        $order = new Order();
                        $order->user_id = $user->id;
                        $order->service_id = $service->id;
                        $order->server_id = $server->id;
                        $order->orderProviderName = env("APP_MAIN_SITE");
                        $order->orderProviderServer = $server->providerServer;
                        $order->order_package = $service->package;
                        $order->object_server = $request->provider_server;
                        $order->object_id = $link;
                        $order->order_id = $orderID;
                        $order->order_code = $orderCode;
                        $order->order_data = json_encode($orderData);
                        $order->start = 0;
                        $order->buff = 0;
                        $order->duration = 30;
                        $order->remaining = 30;
                        $order->posts = 0;
                        $order->price = $price;
                        $order->payment = $total;
                        $order->status = "Processing";
                        $order->ip = $request->ip();
                        $order->note = "Đơn SLL";
                        $order->time = now();
                        $order->domain = $domain;
                        $order->save();

                        if ($order) {
                            // nếu số dư của user nhỏ hơn total thì block user
                            if ($user->balance < $total) {
                                $user->status = "banned";
                                $user->save();
                                return response()->json(
                                    [
                                        "code" => "400",
                                        "status" => "error",
                                        "message" =>
                                            "Tài khoản của bạn đã bị khoá do thực hiện giao dịch không hợp lệ !",
                                    ],
                                    400
                                );
                            }

                            $transaction = new Transaction();
                            $transaction->user_id = $user->id;
                            $transaction->tran_code = $orderCode;
                            $transaction->type = "order";
                            $transaction->action = "sub";
                            $transaction->first_balance = $total;
                            $transaction->before_balance = $user->balance;
                            $transaction->after_balance =
                                $user->balance - $total;
                            $transaction->note =
                                "Thanh toán đơn hàng " . $orderCode;
                            $transaction->ip = $request->ip();
                            $transaction->domain = $domain;
                            $transaction->save();

                            $user->balance = $user->balance - $total;
                            $user->save();

                            if (
                                siteValue("telegram_bot_token") &&
                                siteValue("telegram_chat_id")
                            ) {
                                $bot_notify = new TelegramSdk();
                                $bot_notify->botNotify()->sendMessage([
                                    "chat_id" => $user->telegram_id,
                                    "text" =>
                                        "🛒 <b>Đơn hàng mới được tạo từ website " .
                                        $domain .
                                        " !" .
                                        "</b>\n\n" .
                                        "👤 <b>Khách hàng:</b> " .
                                        $user->name .
                                        " (" .
                                        $user->email .
                                        ")" .
                                        "\n" .
                                        "📦 <b>Gói dịch vụ:</b> " .
                                        $service_platform->name .
                                        " - " .
                                        $service->name .
                                        "\n" .
                                        "🔗 <b>Link hoặc UID:</b> " .
                                        $link .
                                        "\n" .
                                        "🔢 <b>Số lượng:</b> " .
                                        number_format($soluong) .
                                        "\n" .
                                        "🔗 <b>Máy chủ:</b> " .
                                        $server->package_id .
                                        "\n" .
                                        "💰 <b>Giá tiền:</b> " .
                                        $price .
                                        "đ" .
                                        "\n" .
                                        "💵 <b>Thanh toán:</b> " .
                                        $total .
                                        "đ" .
                                        "\n" .
                                        "📝 <b>Ghi chú:</b> " .
                                        "Đơn SLL" .
                                        "\n",
                                    "parse_mode" => "HTML",
                                ]);
                            }

                            if (
                                $user->telegram_id !== null &&
                                $user->notification_telegram
                            ) {
                                $bot_chat = new TelegramSdk();
                                $bot_chat->botChat()->sendMessage([
                                    "chat_id" => $user->telegram_id,
                                    "text" =>
                                        "🛒 <b>Bạn vừa tạo đơn hàng mới từ website " .
                                        $domain .
                                        " !" .
                                        "</b>\n\n" .
                                        "📦 <b>Gói dịch vụ:</b> " .
                                        $service_platform->name .
                                        " - " .
                                        $service->name .
                                        "\n" .
                                        "🔗 <b>Link hoặc UID:</b> " .
                                        $link .
                                        "\n" .
                                        "🔢 <b>Số lượng:</b> " .
                                        number_format($soluong) .
                                        "\n" .
                                        "🔗 <b>Máy chủ:</b> " .
                                        $server->package_id .
                                        "\n" .
                                        "💰 <b>Giá tiền:</b> " .
                                        $price .
                                        "đ" .
                                        "\n" .
                                        "💵 <b>Thanh toán:</b> " .
                                        $total .
                                        "đ" .
                                        "\n" .
                                        "📝 <b>Ghi chú:</b> " .
                                        "Đơn SLL" .
                                        "\n",
                                    "parse_mode" => "HTML",
                                ]);
                            }

                            return response()->json(
                                [
                                    "code" => "200",
                                    "status" => "success",
                                    "message" =>
                                        "Đơn hàng của bạn đã được tạo thành công !",
                                    "data" => [
                                        "id" => $order->id,
                                        "order_code" => $orderCode,
                                        "price" => $price,
                                        "payment" => $total,
                                        "status" => "Processing",
                                    ],
                                ],
                                200
                            );
                        }
                    } else {
                        return response()->json(
                            [
                                "code" => "400",
                                "status" => "error",
                                "message" =>
                                    $result["message"] ??
                                    "Tạo đơn hàng thất bại !",
                            ],
                            400
                        );
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json(
                [
                    "code" => "500",
                    "status" => "error",
                    "message" => $e->getMessage(),
                ],
                500
            );
        }
    }
}
