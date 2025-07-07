<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    public function viewVoucher(Request $request)
    {
        $vouchers = Voucher::where('domain', getDomain())->get();
        if ($vouchers->isEmpty()) {
            $dom = explode('.', getDomain());
            $voucher = new Voucher();
            $voucher->limitUser = '';
            $voucher->name = strtoupper($dom[0]);
            $voucher->timeStart = '';
            $voucher->timeEnd = '';
            $voucher->percent = '';
            $voucher->user_voucher = '';
            $voucher->status = 'inactive';
            $voucher->domain = getDomain();
            $voucher->order = Voucher::max('order') + 1;
            $voucher->save();
            $vouchers = Voucher::where('domain', getDomain())->get();
        }
        return view('admin.voucher.voucher', compact('vouchers'));
    }
    public function createVoucher(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string',
            'limitUser' => 'required|numeric',
            'user_voucher' => 'required',
            'timeStart' => 'required',
            'timeEnd' => 'required',
            'percent' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        }
        $voucher = new Voucher();
        $voucher->limitUser = $request->limitUser;
        $voucher->name = $request->name;
        $voucher->timeStart = $request->timeStart;
        $voucher->timeEnd = $request->timeEnd;
        $voucher->percent = $request->percent;
        $voucher->user_voucher = $request->user_voucher;
        $voucher->status = $request->status;
        $voucher->domain = getDomain(); 
        $voucher->order = Voucher::max('order') + 1;
        $voucher->save();

        return redirect()->back()->with('success', "Tạo voucher mới thành công");
    }
    public function deleteVoucher($id)
    {
        $voucher = Voucher::find($id);

        if (!$voucher) {
            return redirect()->back()->with('error', 'Voucher không tồn tại');
        }
        $voucher->delete();
        return redirect()->back()->with('success', 'Xoá thành công');
    }

}
