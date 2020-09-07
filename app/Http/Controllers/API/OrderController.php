<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function todayOrders()
    {
        $today_orders = Order::with('customer')
                        ->whereDate('created_at', Carbon::today())
                        ->get();
                        
        return response()->json($today_orders);
    }

    public function orderDetail($id)
    {
        $orders = OrderDetail::where('order_id', $id)
                    ->with('products')->get();
            
        return response()->json($orders);
    }

    public function allOrders()
    {
        $orders = Order::latest()->with('customer')->get();
        return response()->json($orders);
    }
}
