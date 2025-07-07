<?php

namespace App\Http\Controllers\CronJob;

use App\Http\Controllers\Controller;
use App\Library\TelegramSdk;
use App\Models\Banking;
use App\Models\Recharge;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function cronPayment(Request $request)
    {
        $payment = Recharge::where('status', 'Pending')->where('domain', getDomain())->get();
        foreach ($payment as $payments) {
            $code = $payments->bank_name;


            if ($code === 'MBBank') {

                $mbbank = Banking::where('domain', $request->getHost())->where('bank_name', 'MBBank')->first();

                if ($mbbank) {
                    $api_token = $mbbank->token;
                    $transfer_code = siteValue('transfer_code');
                    $min_recharge = $mbbank->min_recharge;

                    $ch = curl_init('https://api.vpnfast.vn/api/historymbbank/' . $api_token);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $response = curl_exec($ch);
                    curl_close($ch);
                  
                    $result = json_decode($response, true);

                    $count = 0;
                    if (isset($result['TranList'])) {
                        foreach ($result['TranList'] as $key => $item) {
                            $refNo = $item['refNo'];
                            $description = $item['description'];
                            $creditAmount = $item['creditAmount'];
                            $debitAmount = $item['debitAmount'];
                            $description1 = str_replace(" ", "", $description);
                            if ($creditAmount >= $min_recharge) {
                                $checkId = strpos($description1, $transfer_code);
                                if ($checkId !== false) {
                                    $code_tran1 = "/" . $transfer_code . "(\d+)/";
                                    preg_match($code_tran1, $description1, $matches);
                                    if(isset($matches[1])){
                                        $us = $matches[1];
                                    }
                                    else{
                                        $us = 0;
                                    }
                                    
                                    $ch1 = explode($transfer_code, $description1);
                                    $ch1 = strtoupper($ch1[1]);
                                    $ch1 = str_replace("\n", "", $ch1);
                                    $ch2 = explode('.', $ch1);
                                    $ch1 = $ch2[0];
                                    $ch2 = explode(' ', $ch1);
                                    $idUsers = $ch2[0];
                                   
                                    $paymentss= Recharge::where('order_code', $idUsers)->orWhere('order_code', $ch1)->orWhere('order_code', $us)->where('status', 'Pending')->where('domain', getDomain())->first();

                                    if ($paymentss){
                                        $user = User::find($paymentss->user_id);
                                    }else{
                                        $user= 0;
                                    }
                                    if ($user){
                                    $idUser= $user->id;
                                    $refNo = base64_encode($refNo);
                                    $checkTransaction = Recharge::where('bank_code', $refNo)->first();

                                    if (!$checkTransaction) {
                                       $balance = $user->balance;
                                        $total_recharge = $user->total_recharge;

                                        $percent_promotion = siteValue('percent_promotion');
                                        $start_promotion = siteValue('start_promotion');
                                        $end_promotion = siteValue('end_promotion');

                                        $promotion = 0;

                                        $note = "Bạn thanh toán hóa đơn thành công " . number_format($creditAmount) . " VNĐ từ MBBank. Số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ";
                                        $amountBefore = $creditAmount;
                                        if ($percent_promotion > 0) {
                                            //2024-03-28
                                            $start = Carbon::parse($start_promotion);
                                            $end = Carbon::parse($end_promotion);
                                            $now = Carbon::now();
                                            if ($now->between($start, $end)) {
                                                $promotion = $creditAmount * $percent_promotion / 100;
                                                $creditAmount = $creditAmount + $promotion;
                                                $note = "Bạn thanh toán hóa đơn thành công " . number_format($creditAmount) . " VNĐ từ MBBank. Số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ. Bạn được khuyến mãi " . number_format($promotion) . " VNĐ";
                                            }
                                        }

                                        /* telegra */
                                        

                                        Transaction::create([
                                            'user_id' => $idUser,
                                            'tran_code' => $refNo,
                                            'type' => 'payment',
                                            'action' => 'add',
                                            'first_balance' => $creditAmount,
                                            'before_balance' => $balance,
                                            'after_balance' => $balance + $creditAmount,
                                            'note' => $note,
                                            'ip' => $request->ip(),
                                            'domain' => $request->getHost()
                                        ]);

                                

                                        $user->balance = $balance + $creditAmount;
                                        $user->total_recharge = $total_recharge + $creditAmount;
                                        $user->save();
                                        
                                       
                                        $paymentss->bank_code = $refNo;
                                        $paymentss->real_amount = $creditAmount;
                                        $paymentss->note = $note; 
                                        $paymentss->status="Success";
                                        $paymentss->save();
                                        if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                                            $bot_notify = new TelegramSdk();
                                            $bot_notify->botNotify()->sendMessage([
                                                'chat_id' => siteValue('telegram_chat_id'),
                                                'text' => '🎉 <b>Thông báo nạp tiền</b> 🎉' . PHP_EOL .
                                                    '👤 <b>Người nạp:</b> ' . $user->username . PHP_EOL .
                                                    '💰 <b>Số tiền:</b> ' . number_format($creditAmount) . ' VNĐ' . PHP_EOL .
                                                    '🏦 <b>Loại Bank:</b> ' . "MBBank" . PHP_EOL .
                                                    '📝 <b>Ghi chú:</b> ' . $note . PHP_EOL .
                                                    '🔗 <b>Mã giao dịch:</b> ' . $refNo . PHP_EOL .
                                                    '📅 <b>Thời gian:</b> ' . Carbon::now()->format('d/m/Y H:i:s') . PHP_EOL .
                                                    '🔗 <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                                    '🌐 <b>Domain:</b> ' . $request->getHost(),
                                                'parse_mode' => 'HTML',
                                            ]);
                                        }
                                    } else {
                                         continue;
                                    }
                                }
                                }
                            }
                        }
                    }
                }
            }

            if ($code === 'Vietcombank') {
                $vietcombank = Banking::where('domain', $request->getHost())->where('bank_name', 'Vietcombank')->first();

                if ($vietcombank) {
                    $api_token = $vietcombank->token;
                    $transfer_code = strtolower(siteValue('transfer_code'));

                    $ch = curl_init('https://api.vpnfast.vn/api/historyvietcombank/' . $api_token);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    
                    $result = json_decode($response, true);


                    $count = 0;
                    if (isset($result['transactions'])) {
                    foreach ($result['transactions'] as $key => $item) {
                        $refNo = $item['Reference'];
                        $description = $item['Description'];
                        $creditAmount = str_replace(",", "", $item['Amount']);
                        // $debitAmount = $item['debitAmount'];
                        $description1 = strtolower(str_replace(" ", "", $description));
                        
                       
                            if ($creditAmount >= $vietcombank->min_recharge && $item['CD'] == '+') {
                        
                                $checkId = strpos($description1, $transfer_code);
                             
                                if ($checkId !== false) {
                           
                                    if (preg_match("/" . preg_quote($transfer_code, '/') . "(\d+)/", $description1, $matches)) {
                                        $us = $matches[1];
                                       
                                    }
                                    else{
                                        $us = 0;
                                    }
                                    $ch1 = explode($transfer_code, $description1);
                                    $ch1 = strtolower($ch1[1]);
                                    $ch1 = str_replace("\n", "", $ch1);
                                    $ch2 = explode('.', $ch1);
                                    $ch1 = $ch2[0];
                                    $ch2 = explode(' ', $ch1);
                                    $idUsers = $ch2[0];

                                    $paymentss= Recharge::where('order_code', $idUsers)->orWhere('order_code', $us)->where('status', 'Pending')->where('domain', getDomain())->first();

                                    if ($paymentss){
                                        $user = User::find($paymentss->user_id);
                                    }
                                    if (isset($user)){
                                    $idUser= $user->id;
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

                                        $note = "Bạn thanh toán hóa đơn thành công " . number_format($creditAmount) . " VNĐ từ Vietcombank. Số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ";
                                        $amountBefore = $creditAmount;
                                        if ($percent_promotion > 0) {
                                            //2024-03-28
                                            $start = Carbon::parse($start_promotion);
                                            $end = Carbon::parse($end_promotion);
                                            $now = Carbon::now();
                                            if ($now->between($start, $end)) {
                                                $promotion = $creditAmount * $percent_promotion / 100;
                                                $creditAmount = $creditAmount + $promotion;
                                                $note = "Bạn thanh toán hóa đơn thành công " . number_format($creditAmount) . " VNĐ từ Vietcombank. Số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ. Bạn được khuyến mãi " . number_format($promotion) . " VNĐ";
                                            }
                                        }

                                        Transaction::create([
                                            'user_id' => $idUser,
                                            'tran_code' => $refNo,
                                            'type' => 'payment',
                                            'action' => 'add',
                                            'first_balance' => $creditAmount,
                                            'before_balance' => $balance,
                                            'after_balance' => $balance + $creditAmount,
                                            'note' => $note,
                                            'ip' => $request->ip(),
                                            'domain' => $request->getHost()
                                        ]);


                                        
                                    

                                        $user->balance = $balance + $creditAmount;
                                        $user->total_recharge = $total_recharge + $creditAmount;
                                        $user->save();

                                       
                                        $paymentss->bank_code = $refNo;
                                        $paymentss->real_amount = $creditAmount;
                                        $paymentss->note = $note; 
                                        $paymentss->status="Success";
                                        $paymentss->save();
                                        if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                                            $bot_notify = new TelegramSdk();
                                            $bot_notify->botNotify()->sendMessage([
                                                'chat_id' => siteValue('telegram_chat_id'),
                                                'text' => '🎉 <b>Thông báo nạp tiền</b> 🎉' . PHP_EOL .
                                                    '👤 <b>Người nạp:</b> ' . $user->username . PHP_EOL .
                                                    '💰 <b>Số tiền:</b> ' . number_format($creditAmount) . ' VNĐ' . PHP_EOL .
                                                    '🏦 <b>Loại Bank:</b> ' . "Vietcombank" . PHP_EOL .
                                                    '📝 <b>Ghi chú:</b> ' . $note . PHP_EOL .
                                                    '🔗 <b>Mã giao dịch:</b> ' . $refNo . PHP_EOL .
                                                    '📅 <b>Thời gian:</b> ' . Carbon::now()->format('d/m/Y H:i:s') . PHP_EOL .
                                                    '🔗 <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                                    '🌐 <b>Domain:</b> ' . $request->getHost(),
                                                'parse_mode' => 'HTML',
                                            ]);
                                        }
                                    }
                                }
                                }
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

                $ch = curl_init('https://api.vpnfast.vn/api/historyacbv2/' . $api_token);

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
                                $idUsers = $ch2[0];

                                    $paymentss= Recharge::where('order_code', $idUsers)->orWhere('order_code', $ch1)->where('status', 'Pending')->where('domain', getDomain())->first();

                                     if ($paymentss){
                                        $user = User::find($paymentss->user_id);
                                    }else{
                                        $user= 0;
                                    }
                                    if($user){
                                    $idUser= $user->id;
                                    $refNo = base64_encode($refNo);
                                    $checkTransaction = Recharge::where('bank_code', $refNo)->first();

                                    if (!$checkTransaction) {
                                        $balance = $user->balance;
                                        $total_recharge = $user->total_recharge;

                                        $percent_promotion = siteValue('percent_promotion');
                                        $start_promotion = siteValue('start_promotion');
                                        $end_promotion = siteValue('end_promotion');

                                        $promotion = 0;

                                        $note = "Bạn thanh toán hóa đơn thành công " . number_format($creditAmount) . " VNĐ từ ACB. Số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ";
                                        $amountBefore = $creditAmount;
                                        if ($percent_promotion > 0) {
                                            //2024-03-28
                                            $start = Carbon::parse($start_promotion);
                                            $end = Carbon::parse($end_promotion);
                                            $now = Carbon::now();
                                            if ($now->between($start, $end)) {
                                                $promotion = $creditAmount * $percent_promotion / 100;
                                                $creditAmount = $creditAmount + $promotion;
                                                $note = "Bạn thanh toán hóa đơn thành công " . number_format($creditAmount) . " VNĐ từ ACB. Số dư tài khoản của bạn là " . number_format($balance + $creditAmount) . " VNĐ. Bạn được khuyến mãi " . number_format($promotion) . " VNĐ";
                                            }
                                        }


                                        Transaction::create([
                                            'user_id' => $idUser,
                                            'tran_code' => $refNo,
                                            'type' => 'payment',
                                            'action' => 'add',
                                            'first_balance' => $creditAmount,
                                            'before_balance' => $balance,
                                            'after_balance' => $balance + $creditAmount,
                                            'note' => $note,
                                            'ip' => $request->ip(),
                                            'domain' => $request->getHost()
                                        ]);

                                        

                                        $user->balance = $balance + $creditAmount;
                                        $user->total_recharge = $total_recharge + $creditAmount;
                                        $user->save();
                                       
                                        $paymentss->bank_code = $refNo;
                                        $paymentss->real_amount = $creditAmount;
                                        $paymentss->note = $note; 
                                        $paymentss->status="Success";
                                        $paymentss->save();
                                        /* telegra */
                                        if (siteValue('telegram_bot_token') && siteValue('telegram_chat_id')) {
                                            $bot_notify = new TelegramSdk();
                                            $bot_notify->botNotify()->sendMessage([
                                                'chat_id' => siteValue('telegram_chat_id'),
                                                'text' => '🎉 <b>Thông báo nạp tiền</b> 🎉' . PHP_EOL .
                                                    '👤 <b>Người nạp:</b> ' . $user->username . PHP_EOL .
                                                    '💰 <b>Số tiền:</b> ' . number_format($creditAmount) . ' VNĐ' . PHP_EOL .
                                                    '🏦 <b>Loại Bank:</b> ' . "ACB" . PHP_EOL .
                                                    '📝 <b>Ghi chú:</b> ' . $note . PHP_EOL .
                                                    '🔗 <b>Mã giao dịch:</b> ' . $refNo . PHP_EOL .
                                                    '📅 <b>Thời gian:</b> ' . Carbon::now()->format('d/m/Y H:i:s') . PHP_EOL .
                                                    '🔗 <b>IP:</b> ' . $request->ip() . PHP_EOL .
                                                    '🌐 <b>Domain:</b> ' . $request->getHost(),
                                                'parse_mode' => 'HTML',
                                            ]);
                                        }

                                    } else {
                                        continue;
                                    }
                                }
                                }
                            }
                        }
                    }
                }
            }
            
        }
        return response()->json([
            'code' => 200,
            'message' => 'Check toàn bộ háo đơn thành công.',
            'status' => 'SUCCESS',
        ]);
    }
    
}
