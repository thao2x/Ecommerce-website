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

        return view('admin.order.index', [
            'orders' => $orders,
            'query_prev' =>  $request['query']
        ]);
    }
    
    public function show(string $id) {
        $order = Order::find($id);

        return view('admin.order.detail', [
            'order' => $order
        ]);
    }

    public function update(string $id) {
        Order::find($id)->update(['status' => 2]);

        return redirect()->back();
    }

    public function cancel(string $id) {
        Order::find($id)->update(['status' => 3]);

        return redirect()->back();
    }
}
