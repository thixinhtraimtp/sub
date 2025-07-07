<?php

namespace App\Http\Controllers\CronJob;

use App\Http\Controllers\Api\Service\BaostarController;
use App\Http\Controllers\Api\Service\BoosterviewsController;
use App\Http\Controllers\Api\Service\CheoTuongTacController;
use App\Http\Controllers\Api\Service\Hacklike17Controller;
use App\Http\Controllers\Api\Service\SmmKingController;
use App\Http\Controllers\Api\Service\SubgiareController;
use App\Http\Controllers\Api\Service\TuongTacSaleController;
use App\Http\Controllers\Api\Service\SharegiareController;
use App\Http\Controllers\Api\Service\TanglikeautoController;
use App\Http\Controllers\Api\Service\TraodoisubController;
use App\Http\Controllers\Api\Service\TuongtaccheoController;
use App\Http\Controllers\Api\Service\TwoMxhController;
use App\Http\Controllers\Controller;
use App\Library\TelegramSdk;
use App\Models\Smm;
use App\Models\User;
use App\Models\Order;
use App\Models\Card;
use App\Models\Recharge;
use App\Models\ServiceServer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusOrderServiceController extends Controller {
    public function refundAllOrders(Request $request)
    {
        $domain = $request->getHost();
        $orders = Order::whereIn("status", [
            "PendingRefundCancel",
            "PendingRefundPartial",
        ])
            ->where("domain", $domain)
            ->get();

        if ($orders->isEmpty()) {
            return response()->json(
                [
                    "code" => "200",
                    "status" => "success",
                    "message" => "Không có đơn hàng cần hoàn tiền!",
                ],
                200
            );
        }


        foreach ($orders as $order) {
            if ($order->user === null) {
               continue; 
            }
            if ($order->status === "Refunded") {
                continue; 
            }

            if ($order->status === "Cancelled" || $order->status === "Failed") {
                continue; 
            }

            $server = $order->server;
            $percents = $server->percents ?? 100;
            $orderData = json_decode($order->order_data);
            $quantity = $orderData->quantity;
            $price = $orderData->price;

            $lam = $quantity - ($quantity * $percents) / 100;

            if ($order->status == "PendingRefundCancel") {
                $returned = $quantity;
            } elseif ($order->status == "PendingRefundPartial") {
                $returned = $quantity - $order->buff + $lam;
            }

            $order->status = "Refunded";
            $tranCode = siteValue("madon") . "_" . time() . rand(1000, 9999);
            Transaction::create([
                "user_id" => $order->user_id,
                "tran_code" => $tranCode,
                "type" => "refund",
                "action" => "add",
                "first_balance" => ceil($returned * $price),
                "before_balance" => $order->user->balance,
                "after_balance" =>
                    $order->user->balance + ceil($returned * $price),
                "note" => "Hoàn tiền đơn hàng #" . $order->order_code,
                "ip" => request()->ip(),
                "domain" => $order->domain,
            ]);

            $order->user->balance += ceil($returned * $price);
            $order->user->save();

            if (
                siteValue("telegram_bot_token") &&
                siteValue("telegram_chat_id")
            ) {
                $bot_notify = new TelegramSdk();
                $bot_notify->botNotify()->sendMessage([
                    "chat_id" => siteValue("telegram_chat_id"),
                    "text" =>
                        "Đơn hàng <b>#{$order->order_code}</b> đã được hoàn tiền với số lượng <b>{$returned}</b> tương ứng <b>" .
                        number_format(ceil($returned * $price)) .
                        "đ</b>",
                    "parse_mode" => "HTML",
                ]);
            }

            $order->save();
        }

        return response()->json(
            [
                "code" => "200",
                "status" => "success",
                "message" => "Hoàn tiền cho tất cả các đơn hàng thành công!",
            ],
            200
        );
    }

    public function cronService(Request $request)
    {
        $orders = Order::where("status", "!=", "Completed")
            ->where("status", "!=", "Cancelled")
            ->where("status", "!=", "Refunded")
            ->where("status", "!=", "Failed")
            ->where("status", "!=", "Partial")
            ->where("status", "!=", "Success")
            ->where("status", "!=", "PendingRefundPartial")
            ->where("status", "!=", "PendingRefundCancel")
            ->where("status", "!=", "Partially Refunded")
            ->where("status", "!=", "Partially Completed")
            ->orderBy("id", "desc")
            ->limit(100)
            ->get();
        foreach ($orders as $order) {
            $orderId = $order["order_id"];

            if ($order["orderProviderName"] == "2mxh") {
                $twoMxh = new TwoMxhController();

                $result = $twoMxh->order($orderId);

                if (isset($result) && $result["status"] == true) {
                    foreach ($result["data"] as $data) {
                        $start_number = $data["start_number"];
                        $success_count = $data["success_count"];
                        $status = $data["status"];
                        $id = $data["id"];

                        $order = Order::where("order_id", $id)->first();

                        if ($order) {
                            switch ($status) {
                                case "Running":
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = "Running";
                                    break;
                                case "Completed":
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = "Completed";
                                    break;
                                case "Canceled":
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = "Cancelled";
                                    break;
                                case "Failed":
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = "Failed";
                                    break;
                                case "Paused":
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = "Cancelled";
                                    break;
                                case "Error":
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = "Failed";
                                    break;
                                case "WaitingForRefund":
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = "Cancelled";
                                    break;
                                case "Refund":
                                    $orderData = json_decode(
                                        $order->order_data
                                    );
                                    $quantity = $orderData->quantity;
                                    $price = $orderData->price;

                                    if ($quantity > $success_count) {
                                        $returned = $quantity - $success_count;
                                    } else {
                                        $returned = $quantity;
                                    }

                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = "Refunded";

                                    $tranCode =
                                        siteValue("madon") .
                                        time() .
                                        rand(1000, 9999);
                                    Transaction::create([
                                        "user_id" => $order->user_id,
                                        "tran_code" => $tranCode,
                                        "type" => "refund",
                                        "action" => "add",
                                        "first_balance" => $returned,
                                        "before_balance" =>
                                            $order->user->balance,
                                        "after_balance" =>
                                            $order->user->balance +
                                            ceil($returned * $price),
                                        "note" =>
                                            "Hoàn tiền đơn hàng #" .
                                            $order->order_code,
                                        "ip" => $request->ip(),
                                        "domain" => $order->domain,
                                    ]);

                                    $order->user->balance += ceil(
                                        $returned * $price
                                    );
                                    $order->user->save();

                                    if (
                                        siteValue("telegram_bot_token") &&
                                        siteValue("telegram_chat_id")
                                    ) {
                                        $bot_notify = new TelegramSdk();
                                        $bot_notify->botNotify()->sendMessage([
                                            "chat_id" => siteValue(
                                                "telegram_chat_id"
                                            ),
                                            "text" =>
                                                "Đơn hàng <b>#{$order->order_code}</b> đã được hoàn tiền với số lượng <b>{$returned}</b> tương ứng <b>" .
                                                number_format(
                                                    ceil($returned * $price)
                                                ) .
                                                "đ</b>",
                                            "parse_mode" => "HTML",
                                        ]);
                                    }
                                    break;
                                default:
                                    $order->start = $start_number;
                                    $order->buff = $success_count;
                                    $order->status = "Running";
                                    break;
                            }
                            $order->save();
                        }
                    }
                }
            } elseif ($order["orderProviderName"] == "sharegiare") {
                $sharegr = new SharegiareController();

                $result = $sharegr->order($orderId);

                if (isset($result["status"]) && $result["status"] == true) {
                    if (isset($result["data"])) {
                        foreach ($result["data"] as $data) {
                            if ($data["id"] == $orderId) {
                                $start_number = $data["start"];
                                $success_count = $data["buff"];
                                $status = $data["status"];
                                $id = $data["id"];

                                $order = Order::where("order_id", $id)->first();

                                if ($order) {
                                    switch ($status) {
                                        case "Active":
                                            $order->start = $start_number;
                                            $order->buff = $success_count;
                                            $order->status = "Running";
                                            break;
                                        case "Success":
                                            $order->start = $start_number;
                                            $order->buff = $success_count;
                                            $order->status = "Completed";
                                            break;
                                        case "Cancel":
                                            $order->start = $start_number;
                                            $order->buff = $success_count;
                                            $order->status = "Cancelled";
                                            break;
                                        case "Failed":
                                            $order->start = $start_number;
                                            $order->buff = $success_count;
                                            $order->status = "Failed";
                                            break;
                                        case "Paused":
                                            $order->start = $start_number;
                                            $order->buff = $success_count;
                                            $order->status = "Cancelled";
                                            break;
                                        case "Error":
                                            $order->start = $start_number;
                                            $order->buff = $success_count;
                                            $order->status = "Failed";
                                            break;
                                        case "WaitingForRefund":
                                            $order->start = $start_number;
                                            $order->buff = $success_count;
                                            $order->status = "Cancelled";
                                            break;

                                        default:
                                            $order->start = $start_number;
                                            $order->buff = $success_count;
                                            $order->status = "Running";
                                            break;
                                    }
                                    $order->save();
                                }
                            }
                        }
                    }
                }
            } elseif ($order["orderProviderName"] == "baostar") {
                $baostar = new BaostarController();
                $result = $baostar->order($orderId);

                if (isset($data["success"]) && $data["success"]) {
                    foreach ($result["data"] as $data) {
                        $id = $data["id"];
                        $start_like = $data["start_like"] ?? 0;
                        $count_is_run = $data["count_is_run"] ?? 0;
                        $status = $data["status"] ?? "Active";

                        $order = Order::where("order_id", $id)->first();

                        if ($order) {
                            switch ($status) {
                                case "Active":
                                    $order->start = $start_like;
                                    $order->buff = $count_is_run;
                                    $order->status = "Running";
                                    break;
                                case "done":
                                    $order->start = $start_like;
                                    $order->buff = $count_is_run;
                                    $order->status = "Completed";
                                    break;
                                case "processing":
                                    $order->start = $start_like;
                                    $order->buff = $count_is_run;
                                    $order->status = "Running";
                                    break;
                                case "4":
                                    $order->start = $start_like;
                                    $order->buff = $count_is_run;
                                    $order->status = "Cancelled";
                                    break;
                                case "3":
                                    // refund
                                    $orderData = json_decode(
                                        $order->order_data
                                    );
                                    $quantity = $orderData->quantity;
                                    $price = $orderData->price;

                                    if ($quantity > $count_is_run) {
                                        $returned = $quantity - $count_is_run;
                                    } else {
                                        $returned = $quantity;
                                    }

                                    $order->start = $start_like;
                                    $order->buff = $count_is_run;
                                    $order->status = "Refunded";

                                    $tranCode =
                                        "R_" . time() . rand(1000, 9999);
                                    Transaction::create([
                                        "user_id" => $order->user_id,
                                        "tran_code" => $tranCode,
                                        "type" => "refund",
                                        "action" => "add",
                                        "first_balance" => $returned,
                                        "before_balance" =>
                                            $order->user->balance,
                                        "after_balance" =>
                                            $order->user->balance +
                                            ceil($returned * $price),
                                        "note" =>
                                            "Hoàn tiền đơn hàng #" .
                                            $order->order_code,
                                        "ip" => $request->ip(),
                                        "domain" => $order->domain,
                                    ]);

                                    $order->user->balance += ceil(
                                        $returned * $price
                                    );
                                    $order->user->save();

                                    if (
                                        siteValue("telegram_bot_token") &&
                                        siteValue("telegram_chat_id")
                                    ) {
                                        $bot_notify = new TelegramSdk();
                                        $bot_notify->botNotify()->sendMessage([
                                            "chat_id" => siteValue(
                                                "telegram_chat_id"
                                            ),
                                            "text" =>
                                                "Đơn hàng <b>#{$order->order_code}</b> đã được hoàn tiền với số lượng <b>{$returned}</b> tương ứng <b>" .
                                                number_format(
                                                    ceil($returned * $price)
                                                ) .
                                                "đ</b>",
                                            "parse_mode" => "HTML",
                                        ]);
                                    }
                                    break;
                                default:
                                    $order->start = $start_like;
                                    $order->buff = $count_is_run;
                                    $order->status = "Running";
                                    break;
                            }
                            $order->save();
                        }
                    }
                }
            } elseif ($order["orderProviderName"] == "tanglikeauto") {
                $tanglike = new TanglikeautoController();
                $result = $tanglike->order($orderId);

                if (
                    isset($result["status"]) &&
                    $result["status"] == "success"
                ) {
                    if (isset($result["data"])) {
                        $id = $result["data"]["id"];
                        $start_like = $result["data"]["start_count"] ?? 0;
                        $count_is_run = $result["data"]["buff_count"] ?? 0;
                        $status = $result["data"]["status"] ?? "Active";

                        $order = Order::where("order_id", $id)->first();

                        if ($order) {
                            switch ($status) {
                                case "Active":
                                    $order->start = $start_like;
                                    $order->buff = $count_is_run;
                                    $order->status = "Running";
                                    break;
                                case "done":
                                    $order->start = $start_like;
                                    $order->buff = $count_is_run;
                                    $order->status = "Completed";
                                    break;
                                case "processing":
                                    $order->start = $start_like;
                                    $order->buff = $count_is_run;
                                    $order->status = "Running";
                                    break;
                                case "4":
                                    $order->start = $start_like;
                                    $order->buff = $count_is_run;
                                    $order->status = "Cancelled";
                                    break;
                                case "3":
                                    $order->start = $start_like;
                                    $order->buff = $count_is_run;
                                    $order->status = "Refunded";

                                    break;
                                default:
                                    $order->start = $start_like;
                                    $order->buff = $count_is_run;
                                    $order->status = "Running";
                                    break;
                            }
                            $order->save();
                        }
                    }
                }
            } elseif ($order["orderProviderName"] == "traodoisub") {
                $tds = new TraodoisubController();

                $tds->path = $order["orderProviderPath"];
                $result = $tds->order($order["order_code"]);

                if (isset($result["status"]) && $result["status"] == true) {
                    if (isset($result["data"]["data"])) {
                        foreach ($result["data"]["data"] as $data) {
                            if (
                                isset($data["note"]) &&
                                $data["note"] == $order["order_code"]
                            ) {
                                $code_order = $data["note"];
                                $status = $data["status"];

                                if (isset($data["start"])) {
                                    $start = $data["start"];
                                } else {
                                    $start = 0;
                                }
                                $item = json_decode($order->order_data);
                                $datang = $data["datang"] ?? '0';
                                $buff = $item->quantity - ($data["sl"] - $datang);
                                $order = Order::where(
                                    "order_code",
                                    $code_order
                                )->first();
                                if ($order) {
                                    switch ($status) {
                                        case '<span class="badge badge badge-soft-success">Đang Chạy</span>':
                                            $order->start = $start;
                                            $order->buff = $buff;
                                            $order->status = "Running";
                                            break;
                                        case '<span class="badge badge badge-soft-primary">Hoàn Thành</span>':
                                            $order->start = $start;
                                            $order->buff = $buff;
                                            $order->status = "Completed";
                                            break;
                                        case "Report":
                                            $order->start = $start;
                                            $order->buff = $buff;
                                            $order->status = "Failed";
                                            break;
                                        case '<span class="badge badge badge-soft-warning">Tạm dừng</span>':
                                            $order->start = $start;
                                            $order->buff = $buff;
                                            $order->status = "Holding";
                                            break;
                                        case "Error":
                                            $order->start = $start;
                                            $order->buff = $buff;
                                            $order->status = "Failed";
                                            break;
                                        case "Refund":
                                            $order->start = $start;
                                            $order->buff = $buff;
                                            $order->status = "Refunded";

                                            break;
                                        default:
                                            $order->start = $start;
                                            $order->buff = $buff;
                                            $order->status = "Running";
                                            break;
                                    }
                                    $order->save();
                                }
                            }
                        }
                    }
                }
            } elseif ($order["orderProviderName"] == "tuongtaccheo") {
                $tds = new TuongtaccheoController();

                $tds->path = $order["orderProviderPath"];
                $result = $tds->order($order["order_code"]);

                if (isset($result["status"]) && $result["status"] == true) {
                    if (isset($result["data"])) {
                        foreach ($result["data"] as $data) {
                            if (
                                isset($data["maghinho"]) &&
                                $data["maghinho"] == $order["order_code"]
                            ) {
                                $code_order = $data["maghinho"];

                                if (isset($data["goc"])) {
                                    $start = $data["goc"];
                                } else {
                                    $start = 0;
                                }
                                if ($data["dalen"] - $data["sldat"] >= 0) {
                                    $status = "Success";
                                } else {
                                    $status = "Running";
                                }
                                $item = json_decode($order->order_data);
                                $buff =
                                    $item->quantity -
                                    ($data["sldat"] - $data["dalen"]);
                                $order = Order::where(
                                    "order_code",
                                    $code_order
                                )->first();
                                if ($order) {
                                    $order->start = $start;
                                    $order->buff = $buff;
                                    $order->status = $status;
                                    $order->save();
                                }
                            }
                        }
                    }
                }
            } elseif (
                $order["orderProviderName"] == "subgiare" ||
                $order["orderProviderName"] == "trumsubre"
            ) {
                $subgiare = new SubgiareController();

                $subgiare->path = $order["orderProviderPath"];
                $result = $subgiare->order($orderId);

                if (isset($result["data"][0])) {
                    $start = $result["data"][0]["start"];
                    $buff = $result["data"][0]["buff"];
                    $status = $result["data"][0]["status"];
                    $code_order = $orderId;

                    $order = Order::where("order_id", $code_order)->first();
                    if ($order) {
                        switch ($status) {
                            case "Active":
                                $order->start = $start;
                                $order->buff = $buff;
                                $order->status = "Running";
                                break;
                            case "Success":
                                $order->start = $start;
                                $order->buff = $buff;
                                $order->status = "Completed";
                                break;
                            case "Report":
                                $order->start = $start;
                                $order->buff = $buff;
                                $order->status = "Failed";
                                break;
                            case "Pause":
                                $order->start = $start;
                                $order->buff = $buff;
                                $order->status = "Cancelled";
                                break;
                            case "Error":
                                $order->start = $start;
                                $order->buff = $buff;
                                $order->status = "Failed";
                                break;
                            case "Refund":
                                $orderData = json_decode($order->order_data);
                                $quantity = $orderData->quantity;
                                $price = $orderData->price;

                                if ($quantity > $buff) {
                                    $returned = $quantity - $buff;
                                } else {
                                    $returned = $quantity;
                                }

                                $order->start = $start;
                                $order->buff = $buff;
                                $order->status = "Refunded";

                                $tranCode = "R_" . time() . rand(1000, 9999);
                                Transaction::create([
                                    "user_id" => $order->user_id,
                                    "tran_code" => $tranCode,
                                    "type" => "refund",
                                    "action" => "add",
                                    "first_balance" => $returned,
                                    "before_balance" => $order->user->balance,
                                    "after_balance" =>
                                        $order->user->balance +
                                        ceil($returned * $price),
                                    "note" =>
                                        "Hoàn tiền đơn hàng #" .
                                        $order->order_code,
                                    "ip" => $request->ip(),
                                    "domain" => $order->domain,
                                ]);

                                $order->user->balance += ceil(
                                    $returned * $price
                                );
                                $order->user->save();

                                if (
                                    siteValue("telegram_bot_token") &&
                                    siteValue("telegram_chat_id")
                                ) {
                                    $bot_notify = new TelegramSdk();
                                    $bot_notify->botNotify()->sendMessage([
                                        "chat_id" => siteValue(
                                            "telegram_chat_id"
                                        ),
                                        "text" =>
                                            "Đơn hàng <b>#{$order->order_code}</b> đã được hoàn tiền với số lượng <b>{$returned}</b> tương ứng <b>" .
                                            number_format(
                                                ceil($returned * $price)
                                            ) .
                                            "đ</b>",
                                        "parse_mode" => "HTML",
                                    ]);
                                }
                                break;
                            default:
                                $order->start = $start;
                                $order->buff = $buff;
                                $order->status = "Running";
                                break;
                        }
                        $order->save();
                    }
                }
            } elseif ($order["orderProviderName"] == "hacklike17") {
                $orderId = $order->order_id;
                $hacklike17 = new Hacklike17Controller();

                $result = $hacklike17->statusOrder($orderId);
                if (isset($result) && $result["status"] === 1) {
                    $present = $result["data"][0]["present"];
                    $original = $result["data"][0]["original"];
                    $status = $result["data"][0]["status"];

                    $order = Order::where("order_id", $orderId)->first();

                    if ($order) {
                        switch ($status) {
                            case "-1":
                                $order->start = $present;
                                $order->buff = $original;
                                $order->status = "Processing";
                                break;
                            case "0":
                                $order->start = $present;
                                $order->buff = $original;
                                $order->status = "Running";
                                break;
                            case "1":
                                $order->start = $present;
                                $order->buff = $original;
                                $order->status = "Completed";
                                break;
                            case "2":
                                $order->start = $present;
                                $order->buff = $original;
                                $order->status = "Failed";
                                break;
                            case "2":
                                $order->start = $present;
                                $order->buff = $original;
                                $order->status = "Cancelled";
                                break;
                            case "3":
                                $order->start = $present;
                                $order->buff = $original;
                                $order->status = "Failed";
                                break;
                            case "3":
                                $start = $present;
                                $buff = $original;
                                $orderData = json_decode($order->order_data);
                                $quantity = $orderData->quantity;
                                $price = $orderData->price;

                                if ($quantity > $buff) {
                                    $returned = $quantity - $buff;
                                } else {
                                    $returned = $quantity;
                                }

                                $order->start = $start;
                                $order->buff = $buff;
                                $order->status = "Refunded";

                                $tranCode = "R_" . time() . rand(1000, 9999);
                                Transaction::create([
                                    "user_id" => $order->user_id,
                                    "tran_code" => $tranCode,
                                    "type" => "refund",
                                    "action" => "add",
                                    "first_balance" => $returned,
                                    "before_balance" => $order->user->balance,
                                    "after_balance" =>
                                        $order->user->balance +
                                        ceil($returned * $price),
                                    "note" =>
                                        "Hoàn tiền đơn hàng #" .
                                        $order->order_code,
                                    "ip" => $request->ip(),
                                    "domain" => $order->domain,
                                ]);

                                $order->user->balance += ceil(
                                    $returned * $price
                                );
                                $order->user->save();

                                if (
                                    siteValue("telegram_bot_token") &&
                                    siteValue("telegram_chat_id")
                                ) {
                                    $bot_notify = new TelegramSdk();
                                    $bot_notify->botNotify()->sendMessage([
                                        "chat_id" => siteValue(
                                            "telegram_chat_id"
                                        ),
                                        "text" =>
                                            "Đơn hàng <b>#{$order->order_code}</b> đã được hoàn tiền với số lượng <b>{$returned}</b> tương ứng <b>" .
                                            number_format(
                                                ceil($returned * $price)
                                            ) .
                                            "đ</b>",
                                        "parse_mode" => "HTML",
                                    ]);
                                }
                                break;
                            default:
                                $order->start = $present;
                                $order->buff = $original;
                                $order->status = "Running";
                                break;
                        }
                        $order->save();
                    }
                }
            } else {
                $smm = Smm::where("domain", env("APP_MAIN_SITE"))->get();
                foreach ($smm as $sitesmm) {
                    if ($order["orderProviderName"] == $sitesmm["name"]) {
                        $path = $sitesmm["name"];
                        $token = $sitesmm["token"];
                
                        $post = [
                            "key" => $token,
                            "action" => "status",
                            "orders" => $orderId,
                        ];
                        $result = curl_smm($path, $post);
                
                        if (isset($result[$orderId]["status"])) {
                            $order = Order::where("order_id", $orderId)->first();
                            if (!$order) {
                                continue;
                            }
            
                            if (in_array($order->status, ["Refunded", "PendingRefundCancel", "PendingRefundPartial"])) {
                                continue;
                            }
                
                            $status = $result[$orderId]["status"];
                            $start_count = $result[$orderId]["start_count"];
                            $orderData = json_decode($order->order_data);
                            $sv = ServiceServer::where("id", $order->server_id)
                                               ->where("service_id", $order->service_id)
                                               ->first();
                
                            if (isset($sv->percents)) {
                                $quantity = ($orderData->quantity * $sv->percents) / 100;
                            } else {
                                $quantity = $orderData->quantity;
                            }
                
                            $remains = max(0, $quantity - $result[$orderId]["remains"]);
                
                            switch ($status) {
                                case "In progress":
                                    $order->start = $start_count;
                                    $order->buff = $remains;
                                    $order->status = "Running";
                                    break;
                                case "Completed":
                                    $order->start = $start_count;
                                    $order->buff = $orderData->quantity;
                                    $order->status = "Completed";
                                    break;
                                case "Preparing":
                                    $order->start = $start_count;
                                    $order->buff = $remains;
                                    $order->status = "Pending";
                                    break;
                                case "Canceled":
                                    $order->start = $start_count;
                                    $order->buff = $remains;
                                    $order->status = "PendingRefundCancel";
                                    break;
                                case "Partial":
                                    $order->start = $start_count;
                                    $order->buff = $remains;
                                    $order->status = "PendingRefundPartial";
                                    break;
                                default:
                                    $order->start = $start_count;
                                    $order->buff = $remains;
                                    $order->status = $status;
                                    break;
                            }
                
                            $order->save();
                        }
                    }
                }
            }
        }

        return response()->json([
            "code" => 200,
            "message" => "Cập nhật trạng thái đơn hàng thành công.",
            "status" => "SUCCESS",
        ]);
    }

    public function UpdateService(Request $request)
    {
        $orders = Order::where("orderProviderName", env("APP_MAIN_SITE"))
            ->where("status", "!=", "Completed")
            ->where("status", "!=", "Cancelled")
            ->where("status", "!=", "Refunded")
            ->where("status", "!=", "Failed")
            ->where("status", "!=", "Partially Refunded")
            ->where("status", "!=", "Partially Completed")
            ->orderBy("id", "desc")
            ->limit(100)
            ->get();
        foreach ($orders as $order) {
            $orderId = $order["order_id"];
            $orderme = Order::where("id", $orderId)->first();
            if ($orderme) {
                $ordercon = Order::where("order_id", $orderme->id)->first();
                $ordercon->start = $orderme->start;
                $ordercon->buff = $orderme->buff;
                $ordercon->status = $orderme->status;
                $ordercon->save();
            }
        }
    }
}
