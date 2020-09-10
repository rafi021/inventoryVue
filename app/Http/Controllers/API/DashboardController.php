<?php

namespace App\Http\Controllers\API;

use App\Expense;
use App\Http\Controllers\Controller;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $todaysSell = Order::whereDate('created_at', '=', Carbon::now())->sum('total');
        $todaysEarnings = Order::whereDate('created_at', '=', Carbon::now())->sum('pay_amount');
        $todaysDue = Order::whereDate('created_at', '=', Carbon::now())->sum('due_amount');
        $todaysExpense = Expense::whereDate('expense_date', '=', Carbon::now())->sum('amount');
        
        

        $totalEarnings = Order::sum('total');
        

        return response()->json([
            'todaysSell' => $todaysSell,
            'todaysEarnings' => $todaysEarnings,
            'todaysDue' => $todaysDue,
            'todaysExpense' => $todaysExpense,
            'totalEarnings' => $totalEarnings,
        ],200);
    }
}
