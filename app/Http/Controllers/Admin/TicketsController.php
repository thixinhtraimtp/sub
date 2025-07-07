<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TicketsController extends Controller
{
    public function viewTicket(Request $request)
    {

        $search = $request->search;

        $ticket = Ticket::where('domain', getDomain())
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
                })->orderBy('id', 'desc')->get();

        return view('admin.ticket.ticket', compact('ticket'));
    }

    public function viewEditTicket($id)
    {
        $ticket = Ticket::where('id', $id)->where('domain', getDomain())->first();

        if (!$ticket) {
            return redirect()->back()->with('error', 'Ticket không tồn tại');
        }

        return view('admin.ticket.ticket-edit', compact('ticket'));
    }

    public function updateTicket(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
             
           
            'reply' => 'required'
            
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        } else {

        
                $ticket = Ticket::where('id', $id)->where('domain', getDomain())->first();
                if ($ticket) {
                

                    $ticket->reply = $request->reply;
                    $ticket->status = 'success';
                    $ticket->save();

                    return redirect()->route('admin.ticket.ticket')->with('success', "Phản hồi thành công");
                } else {
                    return redirect()->back()->with('error', "Không tìm thấy dữ liệu");
                }
            
        }
    }

    // public function createSmm(Request $request)
    // {
    //     $valid = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         'token' => 'required|string',
          
    //     ]);

    //     if ($valid->fails()) {
    //         return redirect()->back()->with('error', $valid->errors()->first())->withInput();
    //     } else {

    //         $name = $request->name;

    //         $checkSlug = Smm::where('name', $name)->first();
    //         if ($checkSlug) {
    //             return redirect()->back()->with('error', "Đường link smm đã tồn tại")->withInput();
    //         } else {
    //             // order
    //             $code = Str::random(8);

    //             $platform = new Smm();
    //             $platform->code = $code;
    //             $platform->name = $request->name;
    //             $platform->token = $request->token;
              
    //             $platform->domain = getDomain();
    //             $platform->order = Smm::max('order') + 1;
    //             $platform->save();

    //             return redirect()->back()->with('success', "Thêm thành công");
    //         }
    //     }
    // }

    public function deleteTicket($id)
    {
        $platform = Ticket::where('id', $id)->first();
        if ($platform) {
            $platform->delete();
            return redirect()->back()->with('success', "Xóa thành công");
        } else {
            return redirect()->back()->with('error', "Không tìm thấy dữ liệu");
        }
    }
}
