<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\CartItem;

class OrderController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('api-customer')->user();
        $orders = Order::with('orderItems.variant.product.images', 'shipping', 'promo')->where('customer_id', $customer->id)->where('del_flg', 0)->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    public function show(string $orderId)
    {
        $order = Order::with('orderItems.variant.product.images', 'shipping', 'promo', 'shippingAddress', 'customer')->where('del_flg', 0)->find($orderId);

        if (is_null($order)) {
            return response()->json([
                'status' => false,
                'message' => "This order is not available",
                'data' => []
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => "Order details",
            'data' => $order
        ], 200);
    }

    public function cancel(string $orderId)
    {
        Order::find($orderId)->update(['status' => 2]);

        $order = Order::with('orderItems.variant.product.images', 'shipping', 'promo', 'shippingAddress', 'customer')->where('del_flg', 0)->find($orderId);

        return response()->json([
            'success' => true,
            'message' => "Order Update",
            'data' => $order
        ], 200);
    }

    public function store(Request $request)
    {
        // Lấy thông tin user đang đăng nhập
        $customer = Auth::guard('api-customer')->user();

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
            OrderItem::create([
                'variant_id' => $variant['variant_id'],
                'order_id' => $order->id,
                'quantity' => $variant['quantity']
            ]);
        }

        // Xóa dánh sách sản phẩm trong giỏ hàng
        CartItem::where('customer_id', $customer->id)->delete();

        // Gửi mail cho chủ shop
        $user = User::first();
        Mail::send(
            'mail.new-order',
            array(
                'code' => $code,
            ),
            function ($message) use ($user) {
                $message->to($user->email, 'POJO')->subject('Đơn hàng mới từ Shop POJO');
            }
        );

        // Lấy danh sách order sau khi thêm mới order
        $data = Order::with('orderItems.variant.product.images')->where('customer_id', $customer->id)->where('del_flg', 0)->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }
}
