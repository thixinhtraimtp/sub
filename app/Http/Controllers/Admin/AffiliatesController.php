<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Models\LogRef;
use App\Models\User;
use Illuminate\Http\Request;

class AffiliatesController extends Controller
{
    public function viewAffiliates()
    {
        $search = request()->get('search');

        $affiliates = LogRef::where('domain', request()->getHost())->when($search, function ($query, $search) {$query->where(function ($query) use ($search) {$query->where('id', 'like', '%' . $search . '%')->orWhere('username', 'like', '%' . $search . '%');})->orWhereHas('referrer', function ($query) use ($search) {$query->where('username', 'like', '%' . $search . '%');});})->orderBy('created_at', 'desc')->with('referrer')->get();
        $withdraws = Withdraw::with('user')->orderBy('created_at', 'desc')->where('domain', request()->getHost())->get();
        return view('admin.affiliate.index', compact('affiliates', 'withdraws'));
    }

    public function withdrawRef($id, Request $request)
    {
        try {
            $withdraw = Withdraw::findOrFail($id);

            $request->validate([
                'status' => 'required|in:pending,success',
            ]);

            $withdraw->status = $request->status;
            $withdraw->save();

            return redirect()
                ->route('admin.affiliates')
                ->with('success', "Cập nhật thành công");
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.affiliates')
                ->withErrors(['error' => 'Đã có lỗi xảy ra. Vui lòng thử lại sau.']);
        }
    }
}
