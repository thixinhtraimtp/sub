<?php

namespace App\Http\Controllers\CronJob;

use App\Http\Controllers\Controller;
use App\Library\Pusher;
use App\Library\TelegramSdk;
use App\Models\Banking;
use App\Models\Recharge;
use App\Models\RechargeCard;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class RechargeCronJobController extends Controller
{
 

    public function payment(Request $request, $code)
    {
        $apiDeposit = siteValue('api_deposit');

        if ($code === 'Momo') {
            $momo = Banking::where('domain', $request->getHost())->where('bank_name', 'Momo')->first();

            if ($momo) {
                $token = $momo->token;
                $min_recharge = $momo->min_recharge;

                $transfer_code = siteValue('transfer_code');

                $ch = curl_init('https://api.web2m.com/historyapimomo1h/' . $token);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);

                $result = json_decode($response, true);
                // print_r($result);

                if (isset($result['momoMsg']['tranList'])) {
                    foreach ($result['momoMsg']['tranList'] as $key => $item) {


                        $partnerName = $item['partnerName'];
                        $partnerId = $item['partnerId'];
                        $amount = $item['amount'];
                        $comment = strtolower($item['comment']);
                        $tranId = $item['tranId'];
                        if ($amount < $min_recharge) {
                            continue;
                        }
                        // echo $comment;
                        $checkId = strpos($comment, $transfer_code);
                        if ($checkId !== false) {
                            $ch1 = explode($transfer_code, $comment);
                            $ch1 = strtolower($ch1[1]);
                            $ch1 = str_replace("\n", "", $ch1);
                            $ch2 = explode('.', $ch1);
                            $ch1 = $ch2[0];
                            $ch2 = explode(' ', $ch1);
                            $idUser = $ch2[0];
                            //name bank
                            $name = "Không xác định";
                            $user = User::find($idUser);
                            $tranId = str_replace('-', '', $tranId);
                            $checkTransaction = Recharge::where('bank_code', $tranId)->first();
                            if ($checkTransaction) {
                                echo $idUser;
                                continue;
                            } else {
                                $balance = $user->balance;
                                $total_recharge = $user->total_recharge;

                                $percent_promotion = siteValue('percent_promotion');
                                $start_promotion = siteValue('start_promotion');
                                $end_promotion = siteValue('end_promotion');

                                $promotion = 0;

                                $note = "Bạn đã nạp thành công " . number_format($amount) . " VNĐ từ Momo. Số dư tài khoản của bạn là " . number_format($balance + $amount) . " VNĐm";
                                $amountBefore = $amount;
                                if ($percent_promotion > 0) {
                                    //2024-03-28
                                    $start = Carbon::parse($start_promotion);
                                    $end = Carbon::parse($end_promotion);
                                    $now = Carbon::now();
                                    if ($now->between($start, $end)) {
                                        $promotion = $amount * $percent_promotion / 100;
                                        $amount = $amount + $promotion;
                                        $note = "Bạn đã nạp thành công " . number_format($amount) . " VNĐ từ Momo. Trong đó được khuyến mãi thêm " . number_format($percent_promotion) . "%. Tổng số dư tài khoản của bạn là " . number_format($balance + $amount) . " VNĐ.";
                                    }
                                }


                                Transaction::create([
                                    'user_id' => $idUser,
                                    'tran_code' => $tranId,
                                    'type' => 'recharge',
                                    'action' => 'add',
                                    'first_balance' => $amount,
                                    'before_balance' => $balance,
                                    'after_balance' => $balance + $amount,
                                    'note' => $note,
                                    'ip' => $request->ip(),
                                    'domain' => $request->getHost()
                                ]);

                                Recharge::create([
                                    'user_id' => $idUser,
                                    'order_code' => $tranId,
                                    'bank_code' => $tranId,
                                    'payment_method' => 'Momo',
                                    'bank_name' => $partnerName ?? "Không xác định",
                                    'amount' => $amountBefore,
                                    'real_amount' => $amount,
                                    'status' => 'Success',
                                    'note' => $note,

                                    'domain' => $request->getHost()
                                ]);

                                $user->balance = $balance + $amount;
                                $user->total_recharge = $total_recharge + $amount;
                                $user->save();

                                if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                                    $bot_notify = new TelegramSdk();
                                    $bot_notify->botNotify()->sendMessage([
                                        'chat_id' => siteValue('telegram_chat_id'),
                                        'text' => '➤ <b>' . $request->getHost() . ' - Nạp tiền</b> ' . PHP_EOL .
                                            '➤ <b>Khách hàng:</b> ' . $user->username . PHP_EOL .
                                            '➤ <b>Số tiền:</b> ' . number_format($amount) . ' VNĐ' . PHP_EOL .
                                            '➤ <b>Ngân Hàng:</b> ' . "Momo" . PHP_EOL .
                                            '➤ <b>Mã giao dịch:</b> ' . $tranId . PHP_EOL .
                                            '➤ <b>Thời gian:</b> ' . Carbon::now()->format('H:i:s d/m/Y') . PHP_EOL .
                                            '➤ <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                            '➤ <b>Ghi chú:</b> ' . $note . PHP_EOL,
                                        'parse_mode' => 'HTML',
                                    ]);
                                }
                                


                                    
                                     if ($user->telegram_id !== null && $user->notification_telegram) {
                                        $bot_notify = new TelegramSdk();
                                        $bot_notify->botChat()->sendMessage([
                                            'chat_id' => $user->telegram_id,
                                            'text' => '➤ <b>' . $request->getHost() . ' - Nạp tiền</b> ' . PHP_EOL .
                                                '➤ <b>Khách hàng:</b> ' . $user->username . PHP_EOL .
                                                '➤ <b>Số tiền:</b> ' . number_format($creditAmount) . ' VNĐ' . PHP_EOL .
                                                '➤ <b>Ngân Hàng:</b> ' . "Momo" . PHP_EOL .
                                                '➤ <b>Mã giao dịch:</b> ' . $refNo . PHP_EOL .
                                                '➤ <b>Thời gian:</b> ' . Carbon::now()->format('d/m/Y H:i:s') . PHP_EOL .
                                                '➤ <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                                '➤ <b>Ghi chú:</b> ' . $note . PHP_EOL,
                                            'parse_mode' => 'HTML',
                                        ]);
                                    }
                                // $telegram = new TelegramSdk();

                            }
                        }
                        echo  'Momo' . '<br>';
                    }
                }
            }
        }

        if ($code === 'MBBANK') {

            $mbbank = Banking::where('domain', $request->getHost())->where('bank_name', 'MBBank')->first();

            if ($mbbank) {
                $api_token = $mbbank->token;
                $code_tranfer = siteValue('transfer_code');
                $min_recharge = $mbbank->min_recharge;

                $ch = curl_init('https://' . $apiDeposit . '/historyapimbbank/' . $api_token);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($response, true);
                 print_r($result);

                $count = 0;
                if (isset($result['TranList'])) {
                    foreach ($result['TranList'] as $key => $item) {
                        $refNo = $item['tranId'];
                        $description = $item['description'];
                        $creditAmount = $item['creditAmount'];
                        $debitAmount = $item['debitAmount'];
                        $description1 = str_replace(" ", "", $description);
                       

                        if ($creditAmount >= $min_recharge) {
                            $checkId = strpos($description1, $code_tranfer);
                            // echo $checkId;
                            if ($checkId !== false) {
                                $code_tran1 = "/" . $code_tranfer . "(\d+)/";
                                preg_match($code_tran1, $description1, $matches);
                                if(isset($matches[1])){
                                    $us = $matches[1];
                                }
                                else{
                                    $us = 0;
                                }

                                $ch1 = explode($code_tranfer, $description1);
                                $ch1 = $ch1[1];
                                $ch1 = str_replace("\n", "", $ch1);
                                $ch2 = explode('.', $ch1);
                                $ch1 = $ch2[0];
                                $ch2 = explode(' ', $ch1);
                                $idUser = $ch2[0];

                                $user = User::where('id', $idUser)->orWhere('id', $us)->first();
                                $refNo = base64_encode($refNo);
                                
                                $checkTransaction = Recharge::where('bank_code', $refNo)->first();

                                if (!$user) {
                                    continue;
                                }
                                if (!$checkTransaction) {
                                     
                                     $balance = $user->balance;
                                    $total_recharge = $user->total_recharge;

                                    $percent_promotion = siteValue('percent_promotion');
                                    $start_promotion = siteValue('start_promotion');
                                    $end_promotion = siteValue('end_promotion');

                                    $promotion = 0;

                                    $note = "Bạn đã nạp thành công " . number_format($creditAmount) . " VNĐ từ MBBank. Số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ";
                                    $amountBefore = $creditAmount;
                                    if ($percent_promotion > 0) {
                                        //2024-03-28
                                        $start = Carbon::parse($start_promotion);
                                        $end = Carbon::parse($end_promotion);
                                        $now = Carbon::now();
                                        if ($now->between($start, $end)) {
                                            $promotion = $creditAmount * $percent_promotion / 100;
                                            $creditAmount = $creditAmount + $promotion;
                                            $note = "Bạn đã nạp thành công " . number_format($creditAmount) . " VNĐ từ MBBank. Trong đó được khuyến mãi thêm " . number_format($percent_promotion) . "%. Tổng số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ.";
                                        }
                                    }

                                    Transaction::create([
                                        'user_id' => $idUser,
                                        'tran_code' => $refNo,
                                        'type' => 'recharge',
                                        'action' => 'add',
                                        'first_balance' => $creditAmount,
                                        'before_balance' => $balance,
                                        'after_balance' => $balance + $creditAmount,
                                        'note' => $note,
                                        'ip' => $request->ip(),
                                        'domain' => $request->getHost()
                                    ]);

                                    Recharge::create([
                                        'user_id' => $idUser,
                                        'order_code' => $refNo,
                                        'bank_code' => $refNo,
                                        'payment_method' => 'MBBank',
                                        'bank_name' => 'MBBank',
                                        'amount' => $amountBefore,
                                        'real_amount' => $creditAmount,
                                        'status' => 'Success',
                                        'note' => $note,
                                        'domain' => $request->getHost()
                                    ]);
                                    $user11 = User::where('id', $user->ref_id)->first();
                                    if($user11)
                                    {
                                        if($creditAmount >= 10000)
                                        {
                                            $commission = ($creditAmount * siteValue('percentage_commission_affiliate') / 100);
                                            $user11->total_money_ref = $user11->total_money_ref + $commission;
                                            $user11->referral_money = $user11->referral_money + $commission;
                                            $user11->save();
                                        }
                                        
                                    }

                                    $user->balance = $balance + $creditAmount;
                                    $user->total_recharge = $total_recharge + $creditAmount;
                                    $user->save();
                                    
                                    /* telegra */
                                    if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                                        $bot_notify = new TelegramSdk();
                                        $bot_notify->botNotify()->sendMessage([
                                            'chat_id' => siteValue('telegram_chat_id'),
                                            'text' => '➤ <b>' . $request->getHost() . ' - Nạp tiền</b> ' . PHP_EOL .
                                                '➤ <b>Khách hàng:</b> ' . $user->username . PHP_EOL .
                                                '➤ <b>Số tiền:</b> ' . number_format($creditAmount) . ' VNĐ' . PHP_EOL .
                                                '➤ <b>Ngân Hàng:</b> ' . "MBBank" . PHP_EOL .
                                                '➤ <b>Mã giao dịch:</b> ' . $refNo . PHP_EOL .
                                                '➤ <b>Thời gian:</b> ' . Carbon::now()->format('d/m/Y H:i:s') . PHP_EOL .
                                                '➤ <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                                '➤ <b>Ghi chú:</b> ' . $note . PHP_EOL,
                                            'parse_mode' => 'HTML',
                                        ]);
                                    }

                                    
                                     if ($user->telegram_id !== null && $user->notification_telegram) {
                                        $bot_notify = new TelegramSdk();
                                        $bot_notify->botChat()->sendMessage([
                                            'chat_id' => $user->telegram_id,
                                            'text' => '➤ <b>' . $request->getHost() . ' - Nạp tiền</b> ' . PHP_EOL .
                                                '➤ <b>Khách hàng:</b> ' . $user->username . PHP_EOL .
                                                '➤ <b>Số tiền:</b> ' . number_format($creditAmount) . ' VNĐ' . PHP_EOL .
                                                '➤ <b>Ngân Hàng:</b> ' . "MBBank" . PHP_EOL .
                                                '➤ <b>Mã giao dịch:</b> ' . $refNo . PHP_EOL .
                                                '➤ <b>Thời gian:</b> ' . Carbon::now()->format('d/m/Y H:i:s') . PHP_EOL .
                                                '➤ <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                                '➤ <b>Ghi chú:</b> ' . $note . PHP_EOL,
                                            'parse_mode' => 'HTML',
                                        ]);
                                    }
                                }
                                } else {
                                    continue;
                            }
                            echo 'MBBank' . '<br>';
                        }
                    }
                }
            }
        }
        
        
        
        
        if ($code === 'BIDV') {

            $mbbank = Banking::where('domain', $request->getHost())->where('bank_name', 'BIDV')->first();

            if ($mbbank) {
                $api_token = $mbbank->token;
                $code_tranfer = siteValue('transfer_code');
                $min_recharge = $mbbank->min_recharge;

                $ch = curl_init('https://' . $apiDeposit . '/historyapibidvv2/' . $api_token);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($response, true);
                // print_r($result);

                $count = 0;
                if (isset($result['transactions'])) {
                    foreach ($result['transactions'] as $key => $item) {
                        $refNo = $item['transactionID'];
                        $description = $item['description'];
                        $creditAmount = $item['amount'];
                         
                        $description1 = str_replace(" ", "", $description);
                       

                        if ($creditAmount >= $min_recharge && $result['type'] === 'IN') {
                            $checkId = strpos($description1, $code_tranfer);
                            // echo $checkId;
                            if ($checkId !== false) {
                                $code_tran1 = "/" . $code_tranfer . "(\d+)/";
                                preg_match($code_tran1, $description1, $matches);
                                if(isset($matches[1])){
                                    $us = $matches[1];
                                }
                                else{
                                    $us = 0;
                                }

                                $ch1 = explode($code_tranfer, $description1);
                                $ch1 = $ch1[1];
                                $ch1 = str_replace("\n", "", $ch1);
                                $ch2 = explode('.', $ch1);
                                $ch1 = $ch2[0];
                                $ch2 = explode(' ', $ch1);
                                $idUser = $ch2[0];

                                $user = User::where('id', $idUser)->orWhere('id', $us)->first();
                                $refNo = base64_encode($refNo);
                                
                                $checkTransaction = Recharge::where('bank_code', $refNo)->first();

                                if (!$user) {
                                    continue;
                                }
                                if (!$checkTransaction) {
                                     
                                     $balance = $user->balance;
                                    $total_recharge = $user->total_recharge;

                                    $percent_promotion = siteValue('percent_promotion');
                                    $start_promotion = siteValue('start_promotion');
                                    $end_promotion = siteValue('end_promotion');

                                    $promotion = 0;

                                    $note = "Bạn đã nạp thành công " . number_format($creditAmount) . " VNĐ từ BIDV. Số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ";
                                    $amountBefore = $creditAmount;
                                    if ($percent_promotion > 0) {
                                        //2024-03-28
                                        $start = Carbon::parse($start_promotion);
                                        $end = Carbon::parse($end_promotion);
                                        $now = Carbon::now();
                                        if ($now->between($start, $end)) {
                                            $promotion = $creditAmount * $percent_promotion / 100;
                                            $creditAmount = $creditAmount + $promotion;
                                            $note = "Bạn đã nạp thành công " . number_format($creditAmount) . " VNĐ từ BIDV. Trong đó được khuyến mãi thêm " . number_format($percent_promotion) . "%. Tổng số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ.";
                                        }
                                    }

                                    Transaction::create([
                                        'user_id' => $idUser,
                                        'tran_code' => $refNo,
                                        'type' => 'recharge',
                                        'action' => 'add',
                                        'first_balance' => $creditAmount,
                                        'before_balance' => $balance,
                                        'after_balance' => $balance + $creditAmount,
                                        'note' => $note,
                                        'ip' => $request->ip(),
                                        'domain' => $request->getHost()
                                    ]);

                                    Recharge::create([
                                        'user_id' => $idUser,
                                        'order_code' => $refNo,
                                        'bank_code' => $refNo,
                                        'payment_method' => 'BIDV',
                                        'bank_name' => 'BIDV',
                                        'amount' => $amountBefore,
                                        'real_amount' => $creditAmount,
                                        'status' => 'Success',
                                        'note' => $note,
                                        'domain' => $request->getHost()
                                    ]);
                                    $user11 = User::where('id', $user->ref_id)->first();
                                    if($user11)
                                    {
                                        if($creditAmount >= 10000)
                                        {
                                            $commission = ($creditAmount * siteValue('percentage_commission_affiliate') / 100);
                                            $user11->total_money_ref = $user11->total_money_ref + $commission;
                                            $user11->referral_money = $user11->referral_money + $commission;
                                            $user11->save();
                                        }
                                        
                                    }

                                    $user->balance = $balance + $creditAmount;
                                    $user->total_recharge = $total_recharge + $creditAmount;
                                    $user->save();
                                    
                                    /* telegra */
                                    if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                                        $bot_notify = new TelegramSdk();
                                        $bot_notify->botNotify()->sendMessage([
                                            'chat_id' => siteValue('telegram_chat_id'),
                                            'text' => '➤ <b>' . $request->getHost() . ' - Nạp tiền</b> ' . PHP_EOL .
                                                '➤ <b>Khách hàng:</b> ' . $user->username . PHP_EOL .
                                                '➤ <b>Số tiền:</b> ' . number_format($creditAmount) . ' VNĐ' . PHP_EOL .
                                                '➤ <b>Ngân Hàng:</b> ' . "BIDV" . PHP_EOL .
                                                '➤ <b>Mã giao dịch:</b> ' . $refNo . PHP_EOL .
                                                '➤ <b>Thời gian:</b> ' . Carbon::now()->format('d/m/Y H:i:s') . PHP_EOL .
                                                '➤ <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                                '➤ <b>Ghi chú:</b> ' . $note . PHP_EOL,
                                            'parse_mode' => 'HTML',
                                        ]);
                                    }

                                    
                                     if ($user->telegram_id !== null && $user->notification_telegram) {
                                        $bot_notify = new TelegramSdk();
                                        $bot_notify->botChat()->sendMessage([
                                            'chat_id' => $user->telegram_id,
                                            'text' => '➤ <b>' . $request->getHost() . ' - Nạp tiền</b> ' . PHP_EOL .
                                                '➤ <b>Khách hàng:</b> ' . $user->username . PHP_EOL .
                                                '➤ <b>Số tiền:</b> ' . number_format($creditAmount) . ' VNĐ' . PHP_EOL .
                                                '➤ <b>Ngân Hàng:</b> ' . "BIDV" . PHP_EOL .
                                                '➤ <b>Mã giao dịch:</b> ' . $refNo . PHP_EOL .
                                                '➤ <b>Thời gian:</b> ' . Carbon::now()->format('d/m/Y H:i:s') . PHP_EOL .
                                                '➤ <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                                '➤ <b>Ghi chú:</b> ' . $note . PHP_EOL,
                                            'parse_mode' => 'HTML',
                                        ]);
                                    }
                                }
                                } else {
                                    continue;
                            }
                            echo 'BIDV' . '<br>';
                        }
                    }
                }
            }
        }

        if ($code === 'VCB') {
            $vietcombank = Banking::where('domain', $request->getHost())->where('bank_name', 'Vietcombank')->first();

            if ($vietcombank) {
                $api_token = $vietcombank->token;
                $code_tranfer = siteValue('transfer_code');

                $ch = curl_init('https://' . $apiDeposit . '/historyapivcb/' . $api_token);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);
                // print_r($response);
                $result = json_decode($response, true);

                // die();
                $count = 0;
                if (isset($result['transactions'])) {
                    foreach ($result['transactions'] as $key => $item) {
                        $refNo = $item['Reference'];
                        $description = $item['Description'];
                        $creditAmount = str_replace(",", "", $item['Amount']);
                        // $debitAmount = $item['debitAmount'];
                        $description1 = strtolower(str_replace(" ", "", $description));
                        if ($creditAmount >= $vietcombank->min_recharge && $item['CD'] == '+') {
                            $checkId = strpos($description1, $code_tranfer);
                            // echo $code_tranfer;
                            // die();
                            if ($checkId !== false) {
                                $ch1 = explode($code_tranfer, $description1);
                                $ch1 = strtolower($ch1[1]);
                                $ch1 = str_replace("\n", "", $ch1);
                                $ch2 = explode('.', $ch1);
                                $ch1 = $ch2[0];
                                $ch2 = explode(' ', $ch1);
                                $idUser = $ch2[0];

                                $user = User::find($idUser);

                                $refNo = base64_encode($refNo);
                                $checkTransaction = Recharge::where('bank_code', $refNo)->first();

                                if ($checkTransaction) {
                                    continue;
                                } else {

                                    $balance = $user->balance;
                                    $total_recharge = $user->total_recharge;

                                    $percent_promotion = siteValue('percent_promotion');
                                    $start_promotion = siteValue('start_promotion');
                                    $end_promotion = siteValue('end_promotion');

                                    $promotion = 0;

                                    $note = "Bạn đã nạp thành công " . number_format($creditAmount) . " VNĐ từ Vietcombank. Số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ";
                                    $amountBefore = $creditAmount;
                                    if ($percent_promotion > 0) {
                                        //2024-03-28
                                        $start = Carbon::parse($start_promotion);
                                        $end = Carbon::parse($end_promotion);
                                        $now = Carbon::now();
                                        if ($now->between($start, $end)) {
                                            $promotion = $creditAmount * $percent_promotion / 100;
                                            $creditAmount = $creditAmount + $promotion;
                                            $note = "Bạn đã nạp thành công " . number_format($creditAmount) . " VNĐ từ Vietcombank. Trong đó được khuyến mãi thêm " . number_format($percent_promotion) . "%. Tổng số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ.";
                                        }
                                    }

                                    Transaction::create([
                                        'user_id' => $idUser,
                                        'tran_code' => $refNo,
                                        'type' => 'recharge',
                                        'action' => 'add',
                                        'first_balance' => $creditAmount,
                                        'before_balance' => $balance,
                                        'after_balance' => $balance + $creditAmount,
                                        'note' => $note,
                                        'ip' => $request->ip(),
                                        'domain' => $request->getHost()
                                    ]);


                                    Recharge::create([
                                        'user_id' => $idUser,
                                        'order_code' => $refNo,
                                        'bank_code' => $refNo,
                                        'payment_method' => 'Vietcombank',
                                        'bank_name' => 'Vietcombank',
                                        'amount' => $amountBefore,
                                        'real_amount' => $creditAmount,
                                        'status' => 'Success',
                                        'note' => $note,
                                        'domain' => $request->getHost()
                                    ]);
                                    $user11 = User::where('id', $user->ref_id)->first();
                                    if($user11)
                                    {
                                        if($creditAmount >= 10000)
                                        {
                                            $commission = ($creditAmount * siteValue('percentage_commission_affiliate') / 100);
                                            $user11->total_money_ref = $user11->total_money_ref + $commission;
                                            $user11->referral_money = $user11->referral_money + $commission;
                                            $user11->save();
                                        }
                                        
                                    }

                                    $user->balance = $balance + $creditAmount;
                                    $user->total_recharge = $total_recharge + $creditAmount;
                                    $user->save();
                                    
                                    if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                                        $bot_notify = new TelegramSdk();
                                        $bot_notify->botNotify()->sendMessage([
                                            'chat_id' => siteValue('telegram_chat_id'),
                                            'text' => '➤ <b>' . $request->getHost() . ' - Nạp tiền</b> ' . PHP_EOL .
                                                '➤ <b>Khách hàng:</b> ' . $user->username . PHP_EOL .
                                                '➤ <b>Số tiền:</b> ' . number_format($creditAmount) . ' VNĐ' . PHP_EOL .
                                                '➤ <b>Ngân Hàng:</b> ' . "Vietcombank" . PHP_EOL .
                                                '➤ <b>Mã giao dịch:</b> ' . base64_decode($refNo) . PHP_EOL .
                                                '➤ <b>Thời gian:</b> ' . Carbon::now()->format('d/m/Y H:i:s') . PHP_EOL .
                                                '➤ <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                                '➤ <b>Ghi chú:</b> ' . $note . PHP_EOL,
                                            'parse_mode' => 'HTML',
                                        ]);
                                    }

                                    
                                     if ($user->telegram_id !== null && $user->notification_telegram) {
                                        $bot_notify = new TelegramSdk();
                                        $bot_notify->botChat()->sendMessage([
                                            'chat_id' => $user->telegram_id,
                                            'text' => '➤ <b>' . $request->getHost() . ' - Nạp tiền</b> ' . PHP_EOL .
                                                '➤ <b>Khách hàng:</b> ' . $user->username . PHP_EOL .
                                                '➤ <b>Số tiền:</b> ' . number_format($creditAmount) . ' VNĐ' . PHP_EOL .
                                                '➤ <b>Ngân Hàng:</b> ' . "Vietcombank" . PHP_EOL .
                                                '➤ <b>Mã giao dịch:</b> ' . $refNo . PHP_EOL .
                                                '➤ <b>Thời gian:</b> ' . Carbon::now()->format('d/m/Y H:i:s') . PHP_EOL .
                                                '➤ <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                                '➤ <b>Ghi chú:</b> ' . $note . PHP_EOL,
                                            'parse_mode' => 'HTML',
                                        ]);
                                    }
                                }
                            }
                            echo 'Vietcombank' . '<br>';
                        }
                    }
                }
            }
        }

        if ($code === 'ACB') {
            $acb = Banking::where('domain', $request->getHost())->where('bank_name', 'ACB')->first();

            if ($acb) {
                $api_token = $acb->token;
                $code_tranfer = siteValue('transfer_code');




                $ch = curl_init('https://' . $apiDeposit . '/historyapiacbv2/' . $api_token);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);
                // print_r($response);
              
                $result = json_decode($response, true);
                // dd($result);

                $count = 0;
                if (isset($result['transactions'])) {
                    foreach ($result['transactions'] as $key => $item) {
                        $refNo = $item['transactionID'];
                        $description = $item['description'];
                        $creditAmount = str_replace(",", "", $item['amount']);
                        // $description1 = str_replace(" ", "", $description);
                        $description1 = strtoupper($description);
                         $code_tran = strtoupper($code_tranfer);
                        if ($creditAmount >= $acb->min_recharge && $item['type'] == 'IN') {
                            $checkId = strpos($description1, $code_tran);

                            if ($checkId !== false) {
                                $des= strtoupper($description);
                               
                               
                                $code_tran1= "/".$code_tran."(\d+)/";
                                preg_match($code_tran1, $des, $matches);
                                $us = $matches[1];
                                
                                $ch1 = explode($code_tran, $description1);
                                $ch1 = strtolower($ch1[1]);
                                $ch1 = str_replace("\n", "", $ch1);
                                $ch2 = explode('.', $ch1);
                                $ch1 = $ch2[0];
                                $ch2 = explode(' ', $ch1);
                                $idUser = $ch2[0];
                                // print_r($description1);
                                $user = User::where('id', $idUser)->orWhere('id', $us)->first();
                                if($user){
                                    
                              
                                $refNo = base64_encode($refNo);
                                $checkTransaction = Recharge::where('bank_code', $refNo)->first();

                                if ($checkTransaction) {
                                
                                    continue;
                                } else {
                                    $balance = $user->balance;
                                    $total_recharge = $user->total_recharge;

                                    $percent_promotion = siteValue('percent_promotion');
                                    $start_promotion = siteValue('start_promotion');
                                    $end_promotion = siteValue('end_promotion');

                                    $promotion = 0;

                                    $note = "Bạn đã nạp thành công " . number_format($creditAmount) . " VNĐ từ ACB. Số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ";
                                    $amountBefore = $creditAmount;
                                    if ($percent_promotion > 0) {
                                        //2024-03-28
                                        $start = Carbon::parse($start_promotion);
                                        $end = Carbon::parse($end_promotion);
                                        $now = Carbon::now();
                                        if ($now->between($start, $end)) {
                                            $promotion = $creditAmount * $percent_promotion / 100;
                                            $creditAmount = $creditAmount + $promotion;
                                            $note = "Bạn đã nạp thành công " . number_format($creditAmount) . " VNĐ từ ACB. Trong đó được khuyến mãi thêm " . number_format($percent_promotion) . "%. Tổng số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ.";
                                        }
                                    }
                                    
                                    Transaction::create([
                                        'user_id' => $idUser,
                                        'tran_code' => $refNo,
                                        'type' => 'recharge',
                                        'action' => 'add',
                                        'first_balance' => $creditAmount,
                                        'before_balance' => $balance,
                                        'after_balance' => $balance + $creditAmount,
                                        'note' => $note,
                                        
                                        'ip' => $request->ip(),
                                        'domain' => $request->getHost()
                                    ]);

                                    Recharge::create([
                                        'user_id' => $idUser,
                                        'order_code' => $refNo,
                                        'bank_code' => $refNo,
                                        'payment_method' => 'ACB',
                                        'bank_name' => 'ACB',
                                        'amount' => $amountBefore,
                                        'real_amount' => $creditAmount,
                                        'status' => 'Success',
                                    
                                        'note' => $note,
                                        'domain' => $request->getHost()
                                    ]);
                                    $user11 = User::where('id', $user->ref_id)->first();
                                    if($user11)
                                    {
                                        if($creditAmount >= 10000)
                                        {
                                            $commission = ($creditAmount * siteValue('percentage_commission_affiliate') / 100);
                                            $user11->total_money_ref = $user11->total_money_ref + $commission;
                                            $user11->referral_money = $user11->referral_money + $commission;
                                            $user11->save();
                                        }
                                        
                                    }

                                    $user->balance = $balance + $creditAmount;
                                    $user->total_recharge = $total_recharge + $creditAmount;
                                    $user->save();
                                    

                                    if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                                        $bot_notify = new TelegramSdk();
                                        $bot_notify->botNotify()->sendMessage([
                                            'chat_id' => siteValue('telegram_chat_id'),
                                            'text' => '➤ <b>' . $request->getHost() . ' - Nạp tiền</b> ' . PHP_EOL .
                                                '➤ <b>Khách hàng:</b> ' . $user->username . PHP_EOL .
                                                '➤ <b>Số tiền:</b> ' . number_format($creditAmount) . ' VNĐ' . PHP_EOL .
                                                '➤ <b>Ngân Hàng:</b> ' . "ACB" . PHP_EOL .
                                                '➤ <b>Mã giao dịch:</b> ' . base64_decode($refNo) . PHP_EOL .
                                                '➤ <b>Thời gian:</b> ' . Carbon::now()->format('d/m/Y H:i:s') . PHP_EOL .
                                                '➤ <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                                '➤ <b>Ghi chú:</b> ' . $note . PHP_EOL,
                                            'parse_mode' => 'HTML',
                                        ]);
                                    }

                                    
                                     if ($user->telegram_id !== null && $user->notification_telegram) {
                                        $bot_notify = new TelegramSdk();
                                        $bot_notify->botChat()->sendMessage([
                                            'chat_id' => $user->telegram_id,
                                            'text' => '➤ <b>' . $request->getHost() . ' - Nạp tiền</b> ' . PHP_EOL .
                                                '➤ <b>Khách hàng:</b> ' . $user->username . PHP_EOL .
                                                '➤ <b>Số tiền:</b> ' . number_format($creditAmount) . ' VNĐ' . PHP_EOL .
                                                '➤ <b>Ngân Hàng:</b> ' . "ACB" . PHP_EOL .
                                                '➤ <b>Mã giao dịch:</b> ' . $refNo . PHP_EOL .
                                                '➤ <b>Thời gian:</b> ' . Carbon::now()->format('d/m/Y H:i:s') . PHP_EOL .
                                                '➤ <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                                '➤ <b>Ghi chú:</b> ' . $note . PHP_EOL,
                                            'parse_mode' => 'HTML',
                                        ]);
                                    }
                                

                                }
                                }
                            }
                            echo 'ACB' . '<br>';
                        }
                    }
                }
            }
        }
    }
}
