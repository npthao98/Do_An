<?php

namespace App\Http\Controllers;

class OrderController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $orders = $user->orders;
        }

        $ordersSuccess = $orders->where('status', config('order.success'));
        $ordersPending = $orders->where('status', config('order.pending'));

        return view('fashi.user.list-orders', compact('user', 'ordersSuccess', 'ordersPending'));
    }
}
