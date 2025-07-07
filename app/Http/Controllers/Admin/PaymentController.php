<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banking;
use App\Models\ConfigSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function viewPaymentConfig()
    {

        $momo = Banking::where('domain', request()->getHost())->where('bank_name', 'Momo')->first();
        $mbbank = Banking::where('domain', request()->getHost())->where('bank_name', 'MBBank')->first();
        $vietcombank = Banking::where('domain', request()->getHost())->where('bank_name', 'Vietcombank')->first();
        $acb = Banking::where('domain', request()->getHost())->where('bank_name', 'ACB')->first();
        $bidv = Banking::where('domain', request()->getHost())->where('bank_name', 'BIDV')->first();
        $binance = Banking::where('domain', request()->getHost())->where('bank_name', 'BINANCE')->first();
        // nếu chưa có thông tin ngân hàng thì tạo mới thông tin ngân hàng
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
        if (!$binance) {
            $binance = new Banking();
            $binance->bank_name = 'BINANCE';
            $binance->domain = request()->getHost();
            $binance->status = 'inactive';
            $binance->save();
        }

        return view('admin.payment.config', compact('momo', 'mbbank', 'vietcombank', 'acb', 'binance', 'bidv'));
    }

    public function updatePaymentConfig(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'start_promotion' => 'required|date',
            'end_promotion' => 'required|date',
            'percent_promotion' => 'required|numeric',
            'transfer_code' => 'required|string',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        } else {
            $site = ConfigSite::where('domain', $request->getHost())->first();
            $site->start_promotion = $request->start_promotion;
            $site->end_promotion = $request->end_promotion;
            $site->percent_promotion = $request->percent_promotion;
            $site->transfer_code = $request->transfer_code;
            $site->save();

            return redirect()->back()->with('success', 'Cập nhật cấu hình thanh toán thành công');
        }
    }

    public function updatePayment(Request $request, $bank_name)
    {
        if($bank_name === 'Momo'){
            $valid = Validator::make($request->all(), [
                'status' => 'required|in:active,inactive',
                'account_name' => 'required|string',
                'account_number' => 'required|string',
                'min_recharge' => 'required|numeric',
                'api_key' => 'required|string',
            ]);

            if ($valid->fails()) {
                return redirect()->back()->with('error', $valid->errors()->first())->withInput();
            } else {
                $bank = Banking::where('domain', request()->getHost())->where('bank_name', $bank_name)->first();
                $bank->status = $request->status;
                $bank->account_name = $request->account_name;
                $bank->account_number = $request->account_number;
                $bank->min_recharge = $request->min_recharge;
                $bank->token = $request->api_key;
                $bank->logo = 'assets/images/momo.png';
                $bank->save();

                return redirect()->back()->with('success', 'Cập nhật thông tin ngân hàng thành công');
            }
        }

        if($bank_name === 'MBBank'){
            $valid = Validator::make($request->all(), [
                'status' => 'required|in:active,inactive',
                'account_name' => 'required|string',
                'account_number' => 'required|string',
                'min_recharge' => 'required|numeric',
                'account_username' => 'required|string',
                'account_password' => 'required|string',
                'api_key' => 'required|string',
            ]);

            if ($valid->fails()) {
                return redirect()->back()->with('error', $valid->errors()->first())->withInput();
            } else {
                $bank = Banking::where('domain', request()->getHost())->where('bank_name', $bank_name)->first();
                $bank->status = $request->status;
                $bank->account_name = $request->account_name;
                $bank->account_number = $request->account_number;
                $bank->min_recharge = $request->min_recharge;
                $bank->bank_account = $request->account_username;
                $bank->bank_password = $request->account_password;
                $bank->token = $request->api_key;
                $bank->logo = 'assets/images/mbbank.png';
                $bank->save();

                return redirect()->back()->with('success', 'Cập nhật thông tin ngân hàng thành công');
            }
        }
        
        if($bank_name === 'BIDV'){
            $valid = Validator::make($request->all(), [
                'status' => 'required|in:active,inactive',
                'account_name' => 'required|string',
                'account_number' => 'required|string',
                'min_recharge' => 'required|numeric',
                'account_username' => 'required|string',
                'account_password' => 'required|string',
                'api_key' => 'required|string',
            ]);

            if ($valid->fails()) {
                return redirect()->back()->with('error', $valid->errors()->first())->withInput();
            } else {
                $bank = Banking::where('domain', request()->getHost())->where('bank_name', $bank_name)->first();
                $bank->status = $request->status;
                $bank->account_name = $request->account_name;
                $bank->account_number = $request->account_number;
                $bank->min_recharge = $request->min_recharge;
                $bank->bank_account = $request->account_username;
                $bank->bank_password = $request->account_password;
                $bank->token = $request->api_key;
                $bank->logo = 'assets/images/bidv.png';
                $bank->save();

                return redirect()->back()->with('success', 'Cập nhật thông tin ngân hàng thành công');
            }
        }
        if($bank_name === 'BINANCE'){
            $valid = Validator::make($request->all(), [
                'status' => 'required|in:active,inactive',
                'account_name' => 'required|string',
                'account_number' => 'required|string',
                'min_recharge' => 'required|numeric',
                'account_username' => 'required|string',
                'account_password' => 'required|string',
                'api_key' => 'required|string',
            ]);

            if ($valid->fails()) {
                return redirect()->back()->with('error', $valid->errors()->first())->withInput();
            } else {
                $bank = Banking::where('domain', request()->getHost())->where('bank_name', $bank_name)->first();
                $bank->status = $request->status;
                $bank->account_name = $request->account_name;
                $bank->account_number = $request->account_number;
                $bank->min_recharge = $request->min_recharge;
                $bank->bank_account = $request->account_username;
                $bank->bank_password = $request->account_password;
                $bank->token = $request->api_key;
                $bank->logo = 'assets/images/binance.jpeg';
                $bank->save();

                return redirect()->back()->with('success', 'Cập nhật thông tin ngân hàng thành công');
            }
        }
        if($bank_name === 'ACB'){
            $valid = Validator::make($request->all(), [
                'status' => 'required|in:active,inactive',
                'account_name' => 'required|string',
                'account_number' => 'required|string',
                'min_recharge' => 'required|numeric',
                'account_username' => 'required|string',
                'account_password' => 'required|string',
                'api_key' => 'required|string',
            ]);

            if ($valid->fails()) {
                return redirect()->back()->with('error', $valid->errors()->first())->withInput();
            } else {
                $bank = Banking::where('domain', request()->getHost())->where('bank_name', $bank_name)->first();
                $bank->status = $request->status;
                $bank->account_name = $request->account_name;
                $bank->account_number = $request->account_number;
                $bank->min_recharge = $request->min_recharge;
                $bank->bank_account = $request->account_username;
                $bank->bank_password = $request->account_password;
                $bank->token = $request->api_key;
                $bank->logo = 'assets/images/acb.png';
                $bank->save();

                return redirect()->back()->with('success', 'Cập nhật thông tin ngân hàng thành công');
            }
        }

        if($bank_name === 'Vietcombank'){
            $valid = Validator::make($request->all(), [
                'status' => 'required|in:active,inactive',
                'account_name' => 'required|string',
                'account_number' => 'required|string',
                'min_recharge' => 'required|numeric',
                'account_username' => 'required|string',
                'account_password' => 'required|string',
                'api_key' => 'required|string',
            ]);

            if ($valid->fails()) {
                return redirect()->back()->with('error', $valid->errors()->first())->withInput();
            } else {
                $bank = Banking::where('domain', request()->getHost())->where('bank_name', $bank_name)->first();
                $bank->status = $request->status;
                $bank->account_name = $request->account_name;
                $bank->account_number = $request->account_number;
                $bank->min_recharge = $request->min_recharge;
                $bank->bank_account = $request->account_username;
                $bank->bank_password = $request->account_password;
                $bank->token = $request->api_key;
                $bank->logo = 'assets/images/vietcombank.png';
                $bank->save();

                return redirect()->back()->with('success', 'Cập nhật thông tin ngân hàng thành công');
            }
        }

    }
}
