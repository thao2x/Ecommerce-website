<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Yajra\Datatables\Datatables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.order');
    }

    public function data()
    {
        $orders = Order::with('customer', 'promo', 'orderItems.variant.product', 'shipping')->where('del_flg', 0)->get();
        return Datatables::of($orders)->make();
    }

    public function show(string $orderId)
    {
        $order = Order::find($orderId);
        return view('admin.order-detail', [
            'order' => $order
        ]);
    }

    public function updateCanceled(string $orderId)
    {
        Order::find($orderId)->update(['status' => 2]);
        return redirect()->back();
    }

    public function updateCompleted(string $orderId)
    {
        Order::find($orderId)->update(['status' => 1]);
        return redirect()->back();
    }
}
