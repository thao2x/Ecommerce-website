<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;

class OrderController extends Controller
{
    /**
     * Get the order list
     *
     * @return [type]
     *
     */
    public function index()
    {
        $customer = Auth::guard('api-customer')->user();
        $orders = Order::with('order_items.variant.product.images')->where('customer_id', $customer->id)->get();

        return response()->json([
            'status' => true,
            'message' => "Order list",
            'data' => $orders
        ], Response::HTTP_OK);
    }

    /**
     * Get order details
     *
     * @param string $orderId
     *
     * @return [type]
     *
     */
    public function show(string $orderId)
    {
        $order = Order::with('order_items.variant.product.images')->find($orderId);

        if (is_null($order)) {
            return response()->json([
                'status' => true,
                'message' => "This order is not available",
                'data' => []
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'message' => "Order details",
            'data' => $order
        ], Response::HTTP_OK);
    }

    /**
     * [Description for store]
     *
     * @param Request $request
     *
     * @return [type]
     *
     */
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

        // Lấy danh sách order sau khi thêm mới order
        $data = Order::with('order_items.variant.product.images')->where('customer_id', $customer->id)->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ], Response::HTTP_OK);
    }
}
