<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Library\TelegramSdk;
use App\Models\OrderProduct;
use App\Models\ProducCategories;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeUnit\FunctionUnit;

class OrderProductionController extends Controller
{
    public function getCategories(Request $request)
    {
        $categories = ProducCategories::all();

        $categories->map(function ($category) {
            $newImgUrl = [];
            $list = json_decode($category->image);
            foreach ($list as $image) {
                $newImgUrl[] = asset($image);
            }

            $category->price_format = number_format($category->price, 0, '', '.') . 'đ';

            $category->image = $newImgUrl;

            return $category;
        });

        $categories->makeHidden(['updated_at', 'domain']);
        return response()->json([
            'status' => 'success',
            'message' => 'Lấy danh sách danh mục sản phẩm thành công',
            'data' => $categories
        ]);
    }

    public function getProductBySlug(Request $request, $slug)
    {
        $category = ProducCategories::where('slug', $slug)->where('domain', request()->getHost())->first();
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy danh mục sản phẩm',
                'data' => null
            ]);
        }

        $category->price_format = number_format($category->price, 0, '', '.') . 'đ';

        $newImgUrl = [];
        $list = json_decode($category->image);
        foreach ($list as $image) {
            $newImgUrl[] = asset($image);
        }

        $category->image = $newImgUrl;

        $category->count_product = $category->products->where('status', 'selling')->count();

        $category->makeHidden(['updated_at', 'domain']);
        return response()->json([
            'status' => 'success',
            'message' => 'Lấy danh sách sản phẩm theo danh mục thành công',
            'data' => $category
        ]);
    }

    public function orderProduct(Request $request)
    {

        $api_token = $request->header('X-Access-Token');

        if (!$api_token) {
            return response()->json([
                'code' => '401',
                'status' => 'error',
                'message' => 'Không tìm thấy Bạn chưa đăng nhập !',
            ], 401);
        }

        $domain = $request->getHost();
        $user = User::where('api_token', $api_token)->where('domain', $domain)->first();

        if (!$user) {
            return response()->json([
                'code' => '401',
                'status' => 'error',
                'message' => 'X-Access-Token không hợp lệ 1!',
                'data' => [
                    'domain' => $domain,
                    'api_token' => $api_token,
                ],
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
            'id_product' => 'required|integer',
        ]);

        if ($valid->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $valid->errors()->first(),
                'data' => null
            ]);
        }

        $product = ProducCategories::where('domain', request()->getHost())->where('id', $request->id_product)->first();

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy sản phẩm',
                'data' => null
            ]);
        }

        $price = $product->price;

        if ($user->balance < $price) {
            return response()->json([
                'status' => 'error',
                'message' => 'Số dư không đủ để mua sản phẩm',
                'data' => null
            ]);
        }

        $prodItem = Product::where('category_id', $request->id_product)->where('status', 'selling')->where('data', '!=', '')->first();

        if (!$prodItem) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sản phẩm này hiện không còn hàng',
                'data' => null
            ]);
        }

        $order = OrderProduct::create([
            'user_id' => $user->id,
            'product_id' => $request->id_product,
            'price' => $price,
            'total' => $price,
            'quantity' => 1,
            'status' => 'success',
            'data' => $prodItem->data,
            'domain' => $request->getHost(),
        ]);


        $prodItem->status = 'sold';
        $prodItem->user_buy_id = $user->id;
        $prodItem->save();

        Transaction::create([
            'user_id' => $user->id,
            'tran_code' => bin2hex(random_bytes(7)),
            'type' => 'order',
            'action' => 'order_product',
            'first_balance' => $price,
            'before_balance' => $user->balance,
            'after_balance' => $user->balance - $price,
            'note' => 'Mua sản phẩm ' . $product->name,
            'ip' => $request->ip(),
            'domain' => $request->getHost(),
        ]);

        $user = User::find($user->id);
        $user->balance = $user->balance - $price;
        $user->save();

        // thông báo đơn hàng về telegram

        if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
            $bot_notify = new TelegramSdk();
            $bot_notify->botNotify()->sendMessage([
                'chat_id' => siteValue('telegram_chat_id'),
                'text' => '🛒 <b>Đơn hàng mới được tạo từ website ' . $request->getHost() . ' !' . "</b>\n\n" .
                    '👤 <b>Khách hàng:</b> ' . $user->name . ' (' . $user->email . ')' . "\n" .
                    '📦 <b>Sản phẩm:</b> ' . $product->name . "\n" .
                    '💰 <b>Giá tiền:</b> ' . $price . 'đ' . "\n" .
                    '💵 <b>Thanh toán:</b> ' . $price . 'đ' . "\n",
                'parse_mode' => 'HTML',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Mua hàng thành công',
            'data' => null
        ]);
    }
}
