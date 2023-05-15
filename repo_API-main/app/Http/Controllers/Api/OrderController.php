<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_Item;

class OrderController extends Controller
{
    public function index()
    {
        $customer = \Auth::guard('api-customer')->user();
        $orders = Order::with('order_items.variant.product.images')->where('customer_id', $customer->id)->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    public function show(string $orderId)
    {
        $orders = Order::with('order_items.variant.product.images')->find($orderId);
        
        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    public function store(Request $request)
    {
        
        // Lấy thông tin user đang đăng nhập
        $customer = \Auth::guard('api-customer')->user();
        
        // Tạo code random
        $faker = \Faker\Factory::create();
        $code = $faker->regexify('[A-Z]{5}[0-4]{5}');
        
        // Tạo order
        $order = Order::create([
            'customer_id' => $customer->id,
            'shiping_address_id' => $request['shiping_address_id'],
            'shipping_id' => $request['shipping_id'],
            'promo_id' => $request['promo_id'],
            'code' => $code
        ]);
        
        // Tạo order items từ danh sách varriants truyền lên gồm id và quantity
        $variants = $request['variants'];
        foreach ($variants as $variant) {
            Order_Item::create([
                'variant_id' => $variant['variant_id'],
                'order_id' => $order->id,
                'quantity' => $variant['quantity']
            ]);
        }
        
        // Lấy danh sách order sau khi thêm mới order
        $orders = Order::with('order_items.variant.product.images')->where('customer_id', $customer->id)->get();
        
        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }
}
