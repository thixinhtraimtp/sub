<?php

namespace App\Http\Controllers\Guard;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AffiliateController extends Controller
{
    public function viewWithdraw(Request $request)
    {
        $search = $request->input('search');
        $withdraws = Withdraw::where('user_id', auth()->id())
            ->where('domain', getDomain())
            ->when($search, function ($query, $search) {
                return $query->where('id', 'like', '%' . $search . '%');
            })
            ->orderByDesc('created_at') 
            ->paginate(10);

        return view('guard.affiliate.withdraw', compact('withdraws', 'search'));
    }

    public function createWithdraw(Request $request)
    {

        $min = siteValue('min_withdraw_ref');
        $max = siteValue('max_withdraw_ref');

        try {
            $valid = Validator::make($request->all(), [
                'amount' => 'required|numeric|', 
                'bank_name' => 'required|string',
                'account_number' => 'required|string',
                'account_name' => 'required|string',
            ]);

            if ($valid->fails()) {
                return redirect()
                    ->back()
                    ->with('error', $valid->errors()->first())
                    ->withInput();
            }

            if ($request->amount < $min) {
                return redirect()
                    ->back()
                    ->with('error', 'Số tiền tối thiểu để rút là ' . number_format($min) . ' VNĐ.')
                    ->withInput();
            }

            if ($request->amount > $max) {
                return redirect()
                    ->back()
                    ->with('error', 'Số tiền tối đa có thể rút là ' . number_format($max) . ' VNĐ.')
                    ->withInput();
            }

            // Lấy thông tin người dùng
            $user = auth()->user();

            if ($user->referral_money < $request->amount) {
                return redirect()
                    ->back()
                    ->with('error', 'Bạn không đủ số dư để rút tiền!')
                    ->withInput();
            }

            $amount = $request->amount;
            $user->referral_money -= $amount;
            $user->save();

            $withdraw = new Withdraw();
            $withdraw->amount = $amount;
            $withdraw->bank_name = $request->bank_name;
            $withdraw->account_number = $request->account_number;
            $withdraw->account_name = $request->account_name;
            $withdraw->user_id = auth()->id();
            $withdraw->status = 'pending'; 
            $withdraw->domain = request()->getHost();
            $withdraw->created_at = now();
            $withdraw->updated_at = now();
            $withdraw->save();

            $tranCode = siteValue('madon') . '_' . time() . rand(1000, 9999);
            Transaction::create([
                'user_id' => $user->id,
                'tran_code' => $tranCode,
                'type' => 'withdraw',
                'action' => 'add',
                'first_balance' => $user->referral_money + $amount,
                'before_balance' => $user->referral_money + $amount, 
                'after_balance' => $user->referral_money, 
                'note' => 'Tạo lệnh rút tiền #ID: ' . $withdraw->id, 
                'ip' => $request->ip(),
                'domain' => $withdraw->domain, 
            ]);
            
            if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id_withdraw')) {
                $bot_notify = new TelegramSdk();
                $bot_notify->botNotify()->sendMessage([
                    'chat_id' => siteValue('telegram_chat_id_withdraw'),
                    'text' => '🏦 <b>Lệnh rút tiền mới được tạo!</b>' . "\n\n" .
                        '👤 <b>Khách hàng:</b> ' . $user->name . "\n" .
                        '💰 <b>Số tiền:</b> ' . number_format($amount) . ' VNĐ' . "\n" .
                        '🏛 <b>Ngân hàng:</b> ' . $request->bank_name . "\n" .
                        '📄 <b>Số tài khoản:</b> ' . $request->account_number . "\n" .
                        '🔢 <b>Mã giao dịch:</b> ' . $tranCode . "\n",
                    'parse_mode' => 'HTML',
                ]);
            }

            return redirect()
                ->back()
                ->with('success', 'Tạo lệnh rút tiền thành công!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Đã xảy ra lỗi trong quá trình tạo đơn rút tiền. Vui lòng thử lại.')
                ->withInput();
        }
    }
}
