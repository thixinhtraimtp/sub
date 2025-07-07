<?php

namespace App\Http\Controllers\CronJob;

use App\Http\Controllers\Controller;
use App\Models\Smm;
use App\Models\Order;
use App\Models\ServiceServer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderDataController extends Controller
{

    public function dataOrder(Request $request , $time)
    {
        $orders = Order::where('domain', getDomain())
        ->where('created_at', '>=' ,$time)
        ->get();
        
        return response()->json([
                'code' => '200',
                'status' => 'success',
                'data' => $orders,
        ]);
    }
    
    
}