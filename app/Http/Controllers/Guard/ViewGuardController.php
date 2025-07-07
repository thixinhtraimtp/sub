<?php
namespace App\Http\Controllers\Guard;

use App\Http\Controllers\Controller;
use App\Library\GoogleAuthenticator;
use App\Models\Banking;
use App\Models\Recharge;
use App\Models\Order;
use App\Models\Card;
use App\Models\LogRef;
use App\Models\User;
use App\Models\ServicePlatform;
use App\Models\ServiceServer;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewGuardController extends Controller
{
    public function viewHome()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->level == 'member') {
                if ($user->total_recharge >= siteValue('collaborator')) {
                    $user->level = 'collaborator';
                    $user->save();
                }
            }
            if ($user->level == 'collaborator') {
                if ($user->total_recharge >= siteValue('agency')) {
                    $user->level = 'agency';
                    $user->save();
                }
            }

            if ($user->level == 'agency') {
                if ($user->total_recharge >= siteValue('distributor')) {
                    $user->level = 'distributor';
                    $user->save();
                }
            }
            $totalOrder = [];
            $totalProcessing = [];
            $totalPending = [];
            $totalCanceled = [];
            $totalPendingRefundCancel = [];
            $totalRefund = [];
            $totalCompleted = [];

            for ($month = 1; $month <= 12; $month++) {
                $totalOrder[] = Order::where('domain', request()->getHost())->where('user_id', Auth::id())->whereMonth('created_at', $month)->count();
                $totalProcessing[] = Order::where('domain', request()->getHost())->where('user_id', Auth::id())->where('status', 'Processing')->whereMonth('created_at', $month)->count();
                $totalPending[] = Order::where('domain', request()->getHost())->where('user_id', Auth::id())->where('status', 'Pending')->whereMonth('created_at', $month)->count();
                $totalCanceled[] = Order::where('domain', request()->getHost())->where('user_id', Auth::id())->where('status', 'Cancelled')->whereMonth('created_at', $month)->count();
                $totalPendingRefundCancel[] = Order::where('domain', request()->getHost())->where('user_id', Auth::id())->where('status', 'PendingRefundCancel')->whereMonth('created_at', $month)->count();
                $totalRefund[] = Order::where('domain', request()->getHost())->where('user_id', Auth::id())->where('status', 'Refunded')->whereMonth('created_at', $month)->count();
                $totalCompleted[] = Order::where('domain', request()->getHost())->where('user_id', Auth::id())->where('status', 'Completed')->whereMonth('created_at', $month)->count();
            }

            $labels = [];
            $data = [];

            for ($i = 1; $i <= 12; $i++) {
                $labels[] = 'Tháng ' . $i;
                $data['recharge'][] = Recharge::where('domain', request()->getHost())->where('user_id', Auth::id())->whereMonth('created_at', $i)->sum('real_amount');
            }

            return view('guard.home', compact('totalOrder', 'totalPending', 'totalProcessing', 'totalCanceled', 'totalPendingRefundCancel', 'totalRefund', 'totalCompleted', 'labels', 'data'));
        }
        
        return view('guard.home');
    }
    public function viewRule()
    {
        return view('guard.rule');
    }
    public function viewApi()
    {
        return view('guard.api');
    }
    public function viewAffiliate()
    {
        $affiliates = LogRef::where('ref_id', Auth::id())->where('domain', request()->getHost())
            ->orderBy('id', 'desc')->paginate(10);
        
        $count = User::where('ref_id', Auth::id())->count();
     
        return view('guard.ref', compact('affiliates','count'));
    }

    public function viewProfile()
    {
        $ga = new GoogleAuthenticator();
        $secret = $ga->createSecret();

        $name = request()->getHost() . ':' . Auth::user()->username;
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($name, $secret);

        $user = Auth::user();

        if ($user->two_factor_auth !== 'yes') {
            $user->two_factor_secret = $secret;
            $user->save();
        }

        return view('guard.profile.index', compact('secret', 'qrCodeUrl'));
    }
    public function createRecharge(Request $request)
    {
        $tranId = rand(100000000, 999999999);
        $valid = Validator::make($request->all(), ['amount' => 'required|numeric', 'bank_code' => 'required']);
        if ($valid->fails()) {
            return redirect()
                ->back()
                ->with('error', $valid->errors()->first())
                ->withInput();
        }
        $banks = Banking::where('bank_name', $request->bank_code)
            ->where('domain', getDomain())
            ->where('status', 'active')
            ->first();

        if ($request->amount < $banks->min_recharge) {
            return redirect()
                ->back()
                ->with('error', 'Bạn cần nhập số tiền lớn hơn hoặc bằng ' . number_format($banks->min_recharge) . ' VNĐ');
        } else {
            Recharge::create([
                'user_id' => Auth::id(),
                'order_code' => $tranId,
                'bank_code' => $tranId,
                'payment_method' => 'Thanh toán bằng hóa đơn',
                'bank_name' => $request->bank_code,
                'amount' => $request->amount,
                'real_amount' => 0,
                'status' => 'Pending',
                'note' => '',
                'domain' => getDomain(),
            ]);

            return redirect()
                ->route('account.recharge.payment', ['id' => $tranId])
                ->with('success', 'Tạo hóa đơn thành công!');
        }
    }

    public function viewCreateRecharge($id)
    {
        $payment = Recharge::where('order_code', $id)
            ->where('status', 'Pending')
            ->where('domain', getDomain())
            ->first();
        $paymentsuccess = Recharge::where('order_code', $id)
            ->where('status', 'Success')
            ->where('domain', getDomain())
            ->first();
        if ($paymentsuccess) {
            return redirect()
                ->route('account.recharge')
                ->with('success', 'Thanh toán hóa đơn thành công');
        }
        if (!$payment) {
            return redirect()
                ->route('account.recharge')
                ->with('error', 'Hóa đơn không tồn tại hoặc đã bị hủy');
        }

        $banks = Banking::where('bank_name', $payment->bank_name)
            ->where('domain', getDomain())
            ->first();
        return view('guard.payment', compact('payment', 'banks'));
    }

    public function viewRecharge()
    {
        $momo = Banking::where('domain', request()->getHost())
            ->where('bank_name', 'Momo')
            ->first();
        $mbbank = Banking::where('domain', request()->getHost())
            ->where('bank_name', 'MBBank')
            ->first();
        $vietcombank = Banking::where('domain', request()->getHost())
            ->where('bank_name', 'Vietcombank')
            ->first();
        $acb = Banking::where('domain', request()->getHost())
            ->where('bank_name', 'ACB')
            ->first();

        $bidv = Banking::where('domain', request()->getHost())
            ->where('bank_name', 'BIDV')
            ->first();
        $binance = Banking::where('domain', request()->getHost())
            ->where('bank_name', 'BINANCE')
            ->first();
        $history = Recharge::where('user_id', Auth::id())
            ->where('domain', request()->getHost())
            ->orderBy('id', 'desc')
            ->get();
        $card = Card::where('username', Auth::user()->username)
            ->where('domain', request()->getHost())
            ->orderBy('id', 'desc')
            ->get();

        if (!$momo) {
            $momo = new Banking();
            $momo->bank_name = 'Momo';
            $momo->domain = request()->getHost();
            $momo->status = 'inactive';
            $momo->save();
        }

        if (!$mbbank) {
            $mbbank = new Banking();
            $mbbank->bank_name = 'MBBank';
            $mbbank->domain = request()->getHost();
            $mbbank->status = 'inactive';
            $mbbank->save();
        }

        if (!$bidv) {
            $bidv = new Banking();
            $bidv->bank_name = 'BIDV';
            $bidv->domain = request()->getHost();
            $bidv->status = 'inactive';
            $bidv->save();
        }
        if (!$binance) {
            $binance = new Banking();
            $binance->bank_name = 'BINANCE';
            $binance->domain = request()->getHost();
            $binance->status = 'inactive';
            $binance->save();
        }

        if (!$vietcombank) {
            $vietcombank = new Banking();
            $vietcombank->bank_name = 'Vietcombank';
            $vietcombank->domain = request()->getHost();
            $vietcombank->status = 'inactive';
            $vietcombank->save();
        }

        if (!$acb) {
            $acb = new Banking();
            $acb->bank_name = 'ACB';
            $acb->domain = request()->getHost();
            $acb->status = 'inactive';
            $acb->save();
        }

        return view('guard.recharge', compact('momo', 'mbbank', 'vietcombank', 'acb', 'history', 'card', 'binance', 'bidv'));
    }

    public function viewCard()
    {
        $card = Card::where('username', Auth::user()->username)
            ->where('domain', request()->getHost())
            ->orderBy('id', 'desc')
            ->get();

        return view('guard.card', compact('card'));
    }
    public function viewOrder()
    {
        $platforms = ServicePlatform::where('domain', env('APP_MAIN_SITE'))->get();
        $orders = Order::where('domain', request()->getHost())
            ->where('server_id', 1)->orderBy('created_at', 'desc')->take(10)->get();

        if ($orders->isNotEmpty()) {
            $time_diffs = $orders->map(function ($order) {
                $diffInSeconds = $order->created_at->diffInSeconds($order->updated_at);

                $hours = floor($diffInSeconds / 3600);
                $minutes = floor(($diffInSeconds % 3600) / 60);
                $seconds = $diffInSeconds % 60;

                return ['hours' => $hours, 'minutes' => $minutes, 'seconds' => $seconds];
            });

            $average_time = $time_diffs->reduce(
                function ($carry, $item) {
                    $carry['hours'] += $item['hours'];
                    $carry['minutes'] += $item['minutes'];
                    $carry['seconds'] += $item['seconds'];

                    if ($carry['seconds'] >= 60) {
                        $carry['minutes'] += floor($carry['seconds'] / 60);
                        $carry['seconds'] = $carry['seconds'] % 60;
                    }

                    if ($carry['minutes'] >= 60) {
                        $carry['hours'] += floor($carry['minutes'] / 60);
                        $carry['minutes'] = $carry['minutes'] % 60;
                    }

                    return $carry;
                },
                ['hours' => 0, 'minutes' => 0, 'seconds' => 0]
            );

            $totalOrders = $time_diffs->count();
            $time_diff = ['hours' => floor($average_time['hours'] / $totalOrders), 'minutes' => floor($average_time['minutes'] / $totalOrders), 'seconds' => floor($average_time['seconds'] / $totalOrders)];
        } else {
            $time_diff = ['hours' => 0, 'minutes' => 0, 'seconds' => 0];
        }

        return view('guard.service.order', compact('platforms', 'time_diff'));
    }

    public function viewNew()
    {
        $platforms = ServicePlatform::where('domain', env('APP_MAIN_SITE'))->get();
        return view('guard.service.new', compact('platforms'));
    }

    public function viewMass()
    {
        $social = ServicePlatform::where('domain', env('APP_MAIN_SITE'))->get();

        return view('guard.mass', compact('social'));
    }
    public function Card(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['code' => 401, 'message' => 'Tài khoản chưa được đăng nhập.', 'status' => 'UNAUTHORIZED']);
        }

        $validator = Validator::make(
            $request->all(),
            ['card_type' => 'required', 'card_value' => 'required|numeric', 'card_code' => 'required', 'card_seri' => 'required'],
            [
                'card_seri.required' => 'Seri không được bỏ trống.',
                'card_value.required' => 'Mệnh giá không được bỏ trống.',
                'card_type.required' => 'Loại thẻ không được bỏ trống.',
                'card_code.required' => 'Mã thẻ không được bỏ trống.',
            ]
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', $validator->errors()->first())
                ->withInput();
        } else {
            if (Auth::user()->status !== 'active') {
                return redirect()
                    ->back()
                    ->with('error', 'Tài khoản người dùng đã bị vô hiệu hóa bởi nhà phát triển')
                    ->withInput();
            } else {
                $telco = strtoupper($request->card_type);
                $sign = md5(siteValue('partner_key') . $request->card_code . $request->card_seri);
                $request_id = rand(100000, 999999);
                $data = trumcard1s(siteValue('partner_id'), $telco, $request->card_code, $request->card_seri, $request->card_value, $request_id, $sign);
                if (isset($data)) {
                    if ($data['status'] == 99) {
                        Card::create([
                            'username' => Auth::user()->username,
                            'card_type' => $telco,
                            'card_amount' => $request->card_value,
                            'card_code' => $request->card_code,
                            'card_serial' => $request->card_seri,
                            'card_real_amount' => 0,
                            'status' => 'Pending',
                            'note' => 'Đang chờ xử lý',
                            'tranid' => $data['trans_id'],
                            'domain' => request()->getHost(),
                        ]);

                        return redirect()
                            ->back()
                            ->with('success', 'Nạp thẻ thành công, vui lòng chờ xử lý')
                            ->withInput();
                    } else {
                        return redirect()
                            ->back()
                            ->with('error', $data['message'])
                            ->withInput();
                    }
                } else {
                    return redirect()
                        ->back()
                        ->with('error', 'Đã xảy ra lỗi trong quá trình xử lý')
                        ->withInput();
                }
            }
        }
    }
    public function viewStatistics()
    {
        return view('guard.profile.statistics');
    }

    public function viewTransactions()
    {
        $search = request()->search;

        $transactions = Transaction::where('user_id', Auth::id())
            ->where('domain', request()->getHost())
            ->when($search, function ($query, $search) {
                return $query->where('tran_code', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            //->paginate(10);
            ->get();
        return view('guard.profile.transactions', compact('transactions'));
    }

    public function viewProgress(Request $request)
    {
        $search = $request->search;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $status = $request->status;
        $order = Order::where('user_id', Auth::id())
            ->where('domain', $request->getHost())
            ->when($search, function ($query, $search) {
                return $query->where('order_code', 'like', '%' . $search . '%');
            })
            ->when($start_date, function ($query, $start_date) {
                return $query->where('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query, $end_date) {
                return $query->where('created_at', '<=', $end_date);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $orders = Order::where('user_id', Auth::id())
            ->where('domain', $request->getHost())
            ->when($search, function ($query, $search) {
                return $query->where('order_code', 'like', '%' . $search . '%');
            })
            ->when($start_date, function ($query, $start_date) {
                return $query->where('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query, $end_date) {
                return $query->where('created_at', '<=', $end_date);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('id', 'desc')
            //->paginate(10);
            ->get();

        return view('guard.profile.progress', compact('order', 'orders'));
    }

    public function viewServices()
    {
        $platforms = ServicePlatform::where('domain', env('APP_MAIN_SITE'))->get();

        return view('guard.profile.services', compact('platforms'));
    }
}
