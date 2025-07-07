<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\ProducCategories;
use App\Models\User;
use App\Models\Card;
use App\Models\Recharge;
use App\Models\PartnerWebsite;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Library\TelegramSdk;
use Illuminate\Support\Facades\Validator;

class HistoryController extends Controller
{
    public function viewHistoryOrders(Request $request)
    {
        $search = $request->get("search");
        $search1 = $request->get("search1");
        $status = $request->get("status");
        $domain = $request->getHost();
        $orderProviderName = null;

        if (getDomain() != env("APP_MAIN_SITE")) {
            $w = PartnerWebsite::where("name", $domain)->first();
            $orderProviderName = $w ? $w->domain : null;
        }

        // Tạo truy vấn cơ bản
        $ordersQuery = Order::where("domain", $domain);

        // Thêm điều kiện nếu $orderProviderName không null
        if ($orderProviderName) {
            $ordersQuery->where("orderProviderName", $orderProviderName);
        }

        // Áp dụng tìm kiếm
        $searchTerms = [];
        if (!empty($search)) {
            $searchTerms = array_filter(
                array_map("trim", explode(PHP_EOL, $search))
            );
        }

        $ordersQuery->when($search, function ($query) use (
            $searchTerms,
            $domain
        ) {
            return $query->where(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $query->orWhere(function ($query) use ($term) {
                        $query
                            ->where("id", "like", "%" . $term . "%")
                            ->orWhere("order_code", "like", "%" . $term . "%")
                            ->orWhere("order_id", "like", "%" . $term . "%")
                            ->orWhere("object_id", "like", "%" . $term . "%")
                            ->orWhereHas("user", function ($query) use ($term) {
                                $query->where(
                                    "username",
                                    "like",
                                    "%" . $term . "%"
                                );
                            })
                            ->orWhereHas("server", function ($query) use (
                                $term
                            ) {
                                $query->where(
                                    "name",
                                    "like",
                                    "%" . $term . "%"
                                );
                            })
                            ->orWhereHas("service", function ($query) use (
                                $term
                            ) {
                                $query->where(
                                    "name",
                                    "like",
                                    "%" . $term . "%"
                                );
                            });
                    });
                }
            });
        });

        // Áp dụng lọc theo trạng thái
        $ordersQuery->when($status, function ($query) use ($status) {
            return $query->where("status", $status);
        });

        // Sắp xếp và phân trang
        $orders = $ordersQuery->orderBy("id", "desc")->paginate(10);
        $ordersDontay = Order::where("domain", $request->getHost())
            ->where(function ($query) {
                $query->where("orderProviderName", "dontay");
            })
            ->orderBy("id", "desc")
            ->paginate(10);

        $ordersrefund = Order::where("domain", $request->getHost())
            ->where(function ($query) {
                $query
                    ->where("status", "PendingRefundPartial")
                    ->orWhere("status", "PendingRefundCancel");
            })
            ->when($search1, function ($query) use ($search1) {
                return $query
                    ->where("id", "like", "%" . $search1 . "%")
                    ->orWhereHas("user", function ($query) use ($search1) {
                        $query->where("username", "like", "%" . $search1 . "%");
                    })
                    ->orWhereHas("server", function ($query) use ($search1) {
                        $query->where("name", "like", "%" . $search1 . "%");
                    })
                    ->orWhereHas("service", function ($query) use ($search1) {
                        $query->where("name", "like", "%" . $search1 . "%");
                    })
                    ->orWhere("order_code", "like", "%" . $search1 . "%")
                    ->orWhere("object_id", "like", "%" . $search1 . "%");
            })
            ->orderBy("id", "desc")
            ->paginate(10);

        return view(
            "admin.history.orders",
            compact("orders", "ordersrefund", "ordersDontay")
        );
    }

    public function refundOrder(Request $request)
    {
        $or = Order::where("order_code", $request->order_code)->first();
        $domain = $request->getHost();
        $user = User::where("id", $or->user_id)
            ->where("domain", $domain)
            ->first();

        if (!$user) {
            return response()->json(
                [
                    "code" => "401",
                    "status" => "error",
                    "message" =>
                        "Không tìm thấy tài khoản thích hợp với mã đơn này !",
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
                        "Tài khoản của khách hàng hiện tại không được phép thực hiện hành động này !",
                ],
                401
            );
        }

        $order = Order::where("order_code", $request->order_code)
            ->where("user_id", $user->id)
            ->where("domain", $domain)
            ->first();
        if (!$order) {
            return response()->json(
                [
                    "code" => "400",
                    "status" => "error",
                    "message" => "Không tìm thấy đơn hàng cần hoàn tiền !",
                ],
                400
            );
        }

        if ($order->status === "Refunded") {
            return response()->json(
                [
                    "code" => "400",
                    "status" => "error",
                    "message" => "Đơn hàng này đã được hoàn tiền trước đó !",
                ],
                400
            );
        }

        if ($order->status === "WaitingForRefund") {
            return response()->json(
                [
                    "code" => "400",
                    "status" => "error",
                    "message" => "Đơn hàng này đang chờ hoàn tiền !",
                ],
                400
            );
        }

        if ($order->status === "Completed") {
            return response()->json(
                [
                    "code" => "400",
                    "status" => "error",
                    "message" =>
                        "Đơn hàng này đã hoàn thành không thể hoàn tiền !",
                ],
                400
            );
        }

        if ($order->status === "Cancelled") {
            return response()->json(
                [
                    "code" => "400",
                    "status" => "error",
                    "message" => "Đơn hàng này đã bị hủy không thể hoàn tiền !",
                ],
                400
            );
        }

        if ($order->status === "Failed") {
            return response()->json(
                [
                    "code" => "400",
                    "status" => "error",
                    "message" =>
                        "Đơn hàng này đã thất bại không thể hoàn tiền !",
                ],
                400
            );
        }

        if ($order->status === "Partially Refunded") {
            return response()->json(
                [
                    "code" => "400",
                    "status" => "error",
                    "message" =>
                        "Đơn hàng này đã được hoàn tiền một phần không thể hoàn tiền !",
                ],
                400
            );
        }

        if ($order->status === "Partially Completed") {
            return response()->json(
                [
                    "code" => "400",
                    "status" => "error",
                    "message" =>
                        "Đơn hàng này đã hoàn thành một phần không thể hoàn tiền !",
                ],
                400
            );
        }

        $server = $order->server;

        $orderData = json_decode($order->order_data);
        $quantity = $orderData->quantity;
        $price = $orderData->price;
        $lam = $quantity - ($quantity * $server->percents) / 100;
        if ($order->status == "PendingRefundCancel") {
            $returned = $quantity;
        }
        if ($order->status == "PendingRefundPartial") {
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
            "after_balance" => $order->user->balance + ceil($returned * $price),
            "note" => "Hoàn tiền đơn hàng #" . $order->order_code,
            "ip" => $request->ip(),
            "domain" => $order->domain,
        ]);

        $order->user->balance += ceil($returned * $price);
        $order->user->save();

        if (siteValue("telegram_bot_token") && siteValue("telegram_chat_id")) {
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

        return response()->json(
            [
                "code" => "200",
                "status" => "success",
                "message" => "Hoàn tiền thành công !",
            ],
            200
        );
    }
    public function viewUserHistory(Request $request)
    {
        $search = $request->get("search");
        $action = $request->get("type");
        $perPage = $request->get("per_page", 10); 

        $transactions = Transaction::where("domain", getDomain())
            ->when($search, function ($query, $search) {
                return $query
                    ->where("tran_code", "like", "%" . $search . "%")
                    ->orWhere("note", "like", "%" . $search . "%")
                    ->orWhereHas("user", function ($q) use ($search) {
                        $q->where("username", "like", "%" . $search . "%");
                    });
            })
            ->when($action, function ($query, $action) {
                return $query->where("type", $action);
            })
            ->orderBy("id", "desc")
            ->paginate($perPage); 

        return view("admin.history.user", compact("transactions", "perPage"));
    }

    public function viewHistoryPayment(Request $request)
    {
        $search = $request->get("search");

        $payments = Recharge::where("domain", $request->getHost())
            ->when($search, function ($query) use ($search) {
                return $query
                    ->where("id", "like", "%" . $search . "%")
                    ->orWhereHas("user", function ($query) use ($search) {
                        $query->where("username", "like", "%" . $search . "%");
                    })
                    ->orWhere("order_code", "like", "%" . $search . "%")
                    ->orWhere("payment_method", "like", "%" . $search . "%");
            })
            ->orderBy("id", "desc")
            ->paginate(10);
        $cards = Card::where("domain", $request->getHost())
            ->when($search, function ($query) use ($search) {
                return $query
                    ->where("id", "like", "%" . $search . "%")
                    ->orWhereHas("user", function ($query) use ($search) {
                        $query->where("username", "like", "%" . $search . "%");
                    })
                    ->orWhere("card_serial", "like", "%" . $search . "%")
                    ->orWhere("card_code", "like", "%" . $search . "%");
            })
            ->orderBy("id", "desc")
            ->paginate(10);

        return view("admin.history.payment", compact("payments", "cards"));
    }

    public function orderAction(Request $request, $id)
    {
        $order = Order::where("domain", request()->getHost())->find($id);
        if ($order) {
            $valid = Validator::make($request->all(), [
                "status" => "required",
            ]);

            if ($valid->fails()) {
                return redirect()
                    ->back()
                    ->with("error", "Vui lòng chọn trạng thái");
            } else {
                $order->status = $request->status;
                $order->save();
                return redirect()
                    ->back()
                    ->with(
                        "success",
                        "Cập nhật trạng thái đơn hàng thành công"
                    );
            }
        } else {
            return redirect()
                ->back()
                ->with("error", "Không tìm thấy đơn hàng");
        }
    }
    public function orderActionStart(Request $request, $id)
    {
        $order = Order::where("domain", request()->getHost())->find($id);
        if ($order) {
            $valid = Validator::make($request->all(), [
                "start" => "required",
            ]);

            if ($valid->fails()) {
                return redirect()
                    ->back()
                    ->with("error", "Vui lòng nhập số lượng bắt đầu");
            } else {
                $order->start = $request->start;
                $order->save();
                return redirect()
                    ->back()
                    ->with("success", "Cập nhật thành công");
            }
        } else {
            return redirect()
                ->back()
                ->with("error", "Không tìm thấy đơn hàng");
        }
    }
    public function orderActionBuff(Request $request, $id)
    {
        $order = Order::where("domain", request()->getHost())->find($id);
        if ($order) {
            $valid = Validator::make($request->all(), [
                "buff" => "required",
            ]);

            if ($valid->fails()) {
                return redirect()
                    ->back()
                    ->with("error", "Vui lòng nhập số lượng đã buff");
            } else {
                $order->buff = $request->buff;
                $order->save();
                return redirect()
                    ->back()
                    ->with("success", "Cập nhật thành công");
            }
        } else {
            return redirect()
                ->back()
                ->with("error", "Không tìm thấy đơn hàng");
        }
    }

    public function deleteOrder($id)
    {
        $order = Order::where("domain", request()->getHost())->find($id);
        if ($order) {
            $order->delete();
            return redirect()
                ->back()
                ->with("success", "Xóa đơn hàng thành công");
        } else {
            return redirect()
                ->back()
                ->with("error", "Không tìm thấy đơn hàng");
        }
    }
    public function viewHistoryProductOrders(Request $request)
    {
        $categories = ProducCategories::where('domain', request()->getHost())->get();
        $totalProductSelling = Product::where('domain', request()->getHost())->where('status', 'selling')->count();
        $totalProductOrder = OrderProduct::where('domain', request()->getHost())->where('status', 'success')->count();
        $totalProductProfit = OrderProduct::where('domain', request()->getHost())->sum('price');

        $products = OrderProduct::where('domain', request()->getHost())
        ->when($request->search, function ($query) use ($request) {
            return $query->whereHas('product', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->orderBy('id', 'desc')->paginate(10);
        return view('admin.history.products', compact('products', 'categories', 'totalProductSelling', 'totalProductOrder', 'totalProductProfit'));
    }
}
