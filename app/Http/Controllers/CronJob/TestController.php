<?php

namespace App\Http\Controllers\CronJob;

use App\Models\Order;
use App\Http\Controllers\Controller;
 
class TestController extends Controller
{
    public function demo(){
     $orders = Order::whereIn('status', ['PendingRefundPartial', 'PendingRefundCancel'])->get();
        foreach ($orders as $order) {
            $order->delete();
        }
    }
    
}