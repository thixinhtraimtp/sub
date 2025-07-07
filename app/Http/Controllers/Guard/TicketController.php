<?php

namespace App\Http\Controllers\Guard;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function viewTicket()
    {
        $search = request()->search;
        $ticket = Ticket::where('username',Auth::user()->id)->where('domain', getDomain())
        ->when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate(10);

        return view('guard.ticket', compact('ticket'));
    }


    public function viewEditTicket()
    {
        $ticket = Ticket::where('domain', getDomain())->get();

        return view('guard.ticket.edit', compact('ticket'));
    }
    public function createTicket(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'level' => 'required',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        } else {

            $ticket = new Ticket();
            $ticket->username = Auth::user()->id;
            $ticket->title = $request->title;
            $ticket->body = $request->body;
            $ticket->reply = '';
            $ticket->level = $request->level;
            $ticket->status = 'pending';
            $ticket->domain = request()->getHost();
            $ticket->save();
            if($ticket){
                return redirect()->back()->with('success', 'Tạo ticket thành công!');
            }

            
        }
    }
}
