<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('api-customer')->user();
        $cart = CartItem::with('variant.product.images')->where('customer_id', $customer->id)->get();

        return response()->json([
            'status' => true,
            'message' => "List of products in cart.",
            'data' => $cart
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'variant_id' => ['required'],
            'quantity' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data check error.',
                'data' => $validator->errors()
            ], 200);
        }

        $customer = Auth::guard('api-customer')->user();
        $item = CartItem::where('variant_id', $request['variant_id'])->where('customer_id', $customer->id)->first();

        if ($item == null) {
            CartItem::create([
                'customer_id' => $customer->id,
                'variant_id' => $request['variant_id'],
                'quantity' => $request['quantity']
            ]);
        } else {
            $preQuantity = $item->quantity;
            $item->update([
                'quantity' => $preQuantity + $request['quantity']
            ]);
        }

        $cart = CartItem::with('variant.product.images')->where('customer_id', $customer->id)->get();

        return response()->json([
            'success' => true,
            'message' => "Product added successfully",
            'data' => $cart
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data check error.',
                'data' => $validator->errors()
            ], 200);
        }

        // Tìm đến đối tượng muốn update
        $cartItem = CartItem::findOrFail($id);
        $cartItem->update([
            'quantity' => $request['quantity']
        ]);

        $customer = Auth::guard('api-customer')->user();
        $cart = CartItem::with('variant.product.images')->where('customer_id', $customer->id)->get();

        return response()->json([
            'success' => true,
            'message' => "Product updated successfully",
            'data' => $cart
        ], 200);
    }

    public function destroy(string $id)
    {
        // Tìm đến đối tượng muốn delete
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        $customer = Auth::guard('api-customer')->user();
        $cart = CartItem::with('variant.product.images')->where('customer_id', $customer->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
            'data' => $cart
        ], 200);
    }
}
