<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request) {
        $orders = Order::where(function($query) use ($request) {
            if ($request->has('customer_id')) {
                $query->where('customer_id', $request['customer_id']);
            }
            if ($request->has('query')) {
                $query->where('code', 'LIKE', '%'.$request['query'].'%');
            }
        })->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.order', [
            'orders' => $orders,
            'query_prev' =>  $request['query']
        ]);
    }
    
    public function show(string $orderId) {
        $order = Order::find($orderId);
        return view('admin.order-detail', [
            'order' => $order
        ]);
    }

    public function update(string $orderId) {
        Order::find($orderId)->update(['status' => 2]);
        return redirect()->back();
    }

    public function destroy(string $orderId) {
        Order::find($orderId)->update(['status' => 3]);
        return redirect()->back();
    }
}
