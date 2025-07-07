<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Smm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SmmController extends Controller
{
    public function viewSmm(Request $request)
    {

        $search = $request->search;

        $smms = Smm::where('domain', env("APP_MAIN_SITE"))->when($search, function ($query, $search)
        {
            return $query->where('name', 'like', '%' . $search . '%')->orWhere('token', 'like', '%' . $search . '%');
        })->orderBy('order', 'asc')
            ->get();

        $totalBalance = $smms->sum('balance');
        $totalActive = $smms->where('status', 'active')->count();
        $totalInactive = $smms->where('status', 'inactive')->count();

        return view('admin.service.smm', compact('smms', 'totalBalance', 'totalActive', 'totalInactive'));
    }

    public function viewEditSmm($id)
    {
        $smm = Smm::where('id', $id)->where('domain', env('APP_MAIN_SITE'))
            ->first();

        if (!$smm)
        {
            return redirect()->back()
                ->with('error', 'Smm không tồn tại');
        }

        return view('admin.service.smm-edit', compact('smm'));
    }

    public function updateSmm(Request $request, $id)
    {
        $valid = Validator::make($request->all() , [

        'name' => 'required|string', 'token' => 'required|string', 'tigia' => 'required|string'

        ]);

        if ($valid->fails())
        {
            return redirect()
                ->back()
                ->with('error', $valid->errors()
                ->first())
                ->withInput();
        }
        else
        {

            $smm = Smm::where('id', $id)->where('domain', env('APP_MAIN_SITE'))
                ->first();
            if ($smm)
            {
                // kiểm tra order có trung với order khác không
                $checkOrder = Smm::where('order', $request->order)
                    ->where('id', '!=', $id)->first();
                if ($checkOrder)
                {
                    // thay thứ tự đó thành thứ tự của smm cũ
                    $checkOrder->order = $smm->order;
                    $checkOrder->save();
                }

                $smm->name = $request->name;
                $smm->token = $request->token;
                $smm->tigia = $request->tigia;

                $smm->save();

                return redirect()
                    ->route('admin.service.smm')
                    ->with('success', "Cập nhật thành công");
            }
            else
            {
                return redirect()
                    ->back()
                    ->with('error', "Không tìm thấy dữ liệu");
            }

        }
    }

    public function balanceSmm(Request $request)
    {
        try {
            $smms = Smm::where('domain', env('APP_MAIN_SITE'))->get();
            if ($smms->isEmpty()) {
                return redirect()
                    ->back()
                    ->with('error', "Không có dữ liệu SMM nào");
            }

            foreach ($smms as $smm) {
                $checkOrder = Smm::where('order', $request->order)
                    ->where('id', '!=', $smm->id)
                    ->first();

                if ($checkOrder) {
                    $checkOrder->order = $smm->order;
                    $checkOrder->save();
                }

                $path = $smm->name;

                $post = [
                    'key' => $smm->token,
                    'action' => 'balance',
                ];
                $response = curl_smm($path, $post);
                if (!$response || !isset($response['currency']) || !isset($response['balance'])) {
                    $smm->balance = 0;
                    $smm->status = 'inactive';
                    $smm->save();
                    continue;
                }

                if ($response['currency'] == 'USD') {
                    $balance = $response['balance'] * $smm['tigia'];
                } elseif ($response['currency'] == 'VND') {
                    $balance = $response['balance'];
                } else {
                    $balance = $response['balance'];
                }
                $smm->balance = $balance;
                $smm->status = 'active'; 
                $smm->save();
            }

            return redirect()
                ->route('admin.service.smm')
                ->with('success', "Cập nhật số dư thành công");
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', "Có lỗi xảy ra");
        }
    }

    public function createSmm(Request $request)
    {
        $valid = Validator::make($request->all() , ['name' => 'required|string', 'token' => 'required|string', 'tigia' => 'required|string',

        ]);

        if ($valid->fails())
        {
            return redirect()
                ->back()
                ->with('error', $valid->errors()
                ->first())
                ->withInput();
        }
        else
        {

            $name = $request->name;

            $checkSlug = Smm::where('name', $name)->first();
            if ($checkSlug)
            {
                return redirect()->back()
                    ->with('error', "Đường link smm đã tồn tại")
                    ->withInput();
            }
            else
            {
                // order
                $code = Str::random(8);

                $platform = new Smm();
                $platform->code = $code;
                $platform->name = $request->name;
                $platform->token = $request->token;
                $platform->tigia = $request->tigia;

                $platform->domain = env('APP_MAIN_SITE');
                $platform->order = Smm::max('order') + 1;
                $platform->save();

                return redirect()
                    ->back()
                    ->with('success', "Thêm thành công");
            }
        }
    }

    public function deleteSmm($id)
    {
        $platform = Smm::where('id', $id)->where('domain', env('APP_MAIN_SITE'))
            ->first();
        if ($platform)
        {
            $platform->delete();
            return redirect()
                ->back()
                ->with('success', "Xóa thành công");
        }
        else
        {
            return redirect()
                ->back()
                ->with('error', "Không tìm thấy dữ liệu");
        }
    }
}

