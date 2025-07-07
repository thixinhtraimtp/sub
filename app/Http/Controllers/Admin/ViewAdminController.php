<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Recharge;
use App\Models\Card;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ViewAdminController extends Controller
{
    public function viewDashboard()
    {
        $domain = request()->getHost();
        $totalUser = User::where('domain', request()->getHost())->count();
        $totalBalance = User::where('domain', getDomain())->sum('balance');
        $totalRecharge =  User::where('domain', request()->getHost())->sum('total_recharge') + Transaction::where('domain', request()->getHost())->where('type', 'balance')->sum('first_balance');
        $totalOrderToday = Order::where('domain', request()->getHost())->sum('payment');
        $OrderToday = Order::where('domain', request()->getHost())->whereDate('created_at', Carbon::today())->count();
        $totalOrder = Order::where('domain', request()->getHost())->count();
        $totalUserToday = User::where('domain', request()->getHost())->whereDate('created_at', Carbon::today())->count();
        $totalRevenues =
            Recharge::where('domain', request()->getHost())->sum('real_amount') +
            Card::where('domain', request()->getHost())
                ->where('status', 'Success')
                ->sum('card_real_amount') +
            Transaction::where('domain', request()->getHost())
                ->where('type', 'balance')
                ->sum('first_balance');
        $totalRefund = Transaction::where('domain', request()->getHost())
            ->where('type', 'refund')
            ->sum('first_balance');
        $totalCanceled = Order::where('domain', request()->getHost())
            ->where('status', 'Cancelled')
            ->count();
        $totalCompleted = Order::where('domain', $domain)
            ->where('status', 'Completed')
            ->count();
        $totalRechargeTodasy = Recharge::where('domain', request()->getHost())
            ->whereDate('created_at', Carbon::today())
            ->sum('real_amount');
        $totalTieuToday = Order::where('domain', request()->getHost())
            ->whereDate('created_at', Carbon::today())
            ->sum('payment');
        $totalCardToday = Card::where('domain', request()->getHost())
            ->where('status', 'Success')
            ->whereDate('created_at', Carbon::today())
            ->sum('card_real_amount');
        $totalRechargeToday = $totalCardToday + $totalRechargeTodasy;
        $totalRevenue = $totalRevenues - $totalOrderToday;
        $totalRenvenueToday =
            Recharge::where('domain', request()->getHost())
                ->whereDate('created_at', Carbon::today())
                ->sum('real_amount') +
            Card::where('domain', request()->getHost())
                ->where('status', 'Success')
                ->whereDate('created_at', Carbon::today())
                ->sum('card_real_amount') -
            $totalTieuToday;

        $labels = [];
        $data = ['recharge' => [], 'order' => [], 'user' => []];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = 'Tháng ' . $i;
            $data['recharge'][] = Recharge::where('domain', $domain)
                ->whereMonth('created_at', $i)
                ->sum('real_amount');
            $data['order'][] = Order::where('domain', $domain)
                ->whereMonth('created_at', $i)
                ->sum('payment');
            $data['user'][] = User::where('domain', $domain)
                ->whereMonth('created_at', $i)
                ->count();
        }

        $totalOrderStatus = [
            'totalOrder' => [],
            'totalProcessing' => [],
            'totalPending' => [],
            'totalCanceled' => [],
            'totalPendingRefundCancel' => [],
            'totalRefund' => [],
            'totalCompleted' => [],
        ];

        for ($month = 1; $month <= 12; $month++) {
            $totalOrderStatus['totalOrder'][] = Order::where('domain', $domain)
                ->whereMonth('created_at', $month)
                ->count();
            $totalOrderStatus['totalProcessing'][] = Order::where('domain', $domain)
                ->where('status', 'Processing')
                ->whereMonth('created_at', $month)
                ->count();
            $totalOrderStatus['totalPending'][] = Order::where('domain', $domain)
                ->where('status', 'Pending')
                ->whereMonth('created_at', $month)
                ->count();
            $totalOrderStatus['totalCanceled'][] = Order::where('domain', $domain)
                ->where('status', 'Cancelled')
                ->whereMonth('created_at', $month)
                ->count();
            $totalOrderStatus['totalPendingRefundCancel'][] = Order::where('domain', $domain)
                ->where('status', 'PendingRefundCancel')
                ->whereMonth('created_at', $month)
                ->count();
            $totalOrderStatus['totalRefund'][] = Order::where('domain', $domain)
                ->where('status', 'Refunded')
                ->whereMonth('created_at', $month)
                ->count();
            $totalOrderStatus['totalCompleted'][] = Order::where('domain', $domain)
                ->where('status', 'Completed')
                ->whereMonth('created_at', $month)
                ->count();
        }

        return view(
            'admin.dashboard',
            compact(
                'totalUser', 'totalBalance', 'totalOrder', 'totalRecharge', 'totalTieuToday', 'OrderToday', 'totalUserToday', 'totalRenvenueToday', 'totalRevenue', 'totalRefund', 'totalCanceled', 'totalCompleted', 'totalRechargeToday', 'labels', 'data', 'totalOrderStatus'
            )
        );
    }

    public function viewWebsiteConfig()
    {
        return view('admin.website.config');
    }
    public function viewCron()
    {
        return view('admin.cron');
    }
}
