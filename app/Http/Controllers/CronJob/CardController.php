<?php

namespace App\Http\Controllers\CronJob;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use App\Library\TelegramSdk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CardController extends Controller
{
    public function cronRecharge(Request $request)
    {

        if (isset($request->status)) {
            $status = $request->status;
            $code = $request->code;
            $serial = $request->serial;

            $trans_id = $request->trans_id;

            $callback_sign = $request->callback_sign;

            $cardRecharge = Card::where('tranid', $trans_id)->first();
            if ($cardRecharge) {
                $amount = $cardRecharge->card_amount;
                $card_discount = siteValue('percent');
                $sign = md5(siteValue('partner_key') . $code . $serial);
                if ($sign == $callback_sign) {
                    if ($status == 1 && $amount > 0) {
                        $tiennhan = $amount - ($amount * $card_discount / 100);
                        $user = User::where('username', $cardRecharge->username)->first();
                        if ($user) {

                            $tranCode = siteValue('madon') . rand(100000000, 999999999);

                            Transaction::create([
                                'user_id' => $user->id,
                                'tran_code' => $tranCode,
                                'type' => 'payment',
                                'action' => 'add',
                                'first_balance' => $user->balance,
                                'before_balance' => $tiennhan,
                                'after_balance' => $user->balance + $tiennhan,
                                'note' => $request->message,
                                'ip' => $request->ip(),
                                'domain' => $request->getHost()
                            ]);


                            $user->balance = $user->balance + $tiennhan;
                            $user->total_recharge = $user->total_recharge + $tiennhan;
                            $user->save();


                            $cardRecharge->discount = $card_discount;
                            $cardRecharge->card_real_amount = $tiennhan;
                            $cardRecharge->status = 'Success';
                            $cardRecharge->save();
                            if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                                try {
                                    $bot_notify = new TelegramSdk();
                                    $bot_notify->botNotify()->sendMessage([
                                        'chat_id' => siteValue('telegram_chat_id'),
                                        'text' => '🎉 <b>Thông báo nạp tiền</b> 🎉' . PHP_EOL .
                                            '👤 <b>Người nạp:</b> ' . $user->username . PHP_EOL .
                                            '💰 <b>Số tiền:</b> ' . number_format($amount) . ' VNĐ' . PHP_EOL .
                                            '🏦 <b>Loại:</b> ' . "Thẻ cào $code" . PHP_EOL .
                                            '📝 <b>Ghi chú:</b> ' . $request->message . PHP_EOL .
                                            '🔗 <b>Mã giao dịch:</b> ' . $tranCode . PHP_EOL .
                                            '📅 <b>Thời gian:</b> ' . Carbon::now()->format('d/m/Y H:i:s') . PHP_EOL .
                                            '🔗 <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                            '🌐 <b>Domain:</b> ' . $request->getHost(),
                                        'parse_mode' => 'HTML',
                                    ]);
                                } catch (\Exception $e) {

                                }
                            }

                        }
                    } else {
                        $cardRecharge->status = 'Error';
                        $cardRecharge->save();
                    }
                }
            }
        }

    }


}