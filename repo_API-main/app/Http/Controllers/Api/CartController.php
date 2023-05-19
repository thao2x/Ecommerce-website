<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return [type]
     *
     */
    public function index()
    {
        $customer = Auth::guard('api-customer')->user();
        $cart = CartItem::with('variant.product.images')->where('customer_id', $customer->id)->get();

        return response()->json([
            'status' => true,
            'message' => "List of products in cart.",
            'data' => $cart
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return [type]
     *
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => ['required'],
            'variant_id' => ['required'],
            'quantity' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data check error.',
                'data' => $validator->errors()
            ], Response::HTTP_OK);
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
        ], Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param CartItem $cartItem
     *
     * @return [type]
     *
     */
    public function update(Request $request, CartItem $cartItem)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data check error.',
                'data' => $validator->errors()
            ], Response::HTTP_OK);
        }

        $cartItem->update([
            'quantity' => $request['quantity']
        ]);

        $customer = Auth::guard('api-customer')->user();
        $cart = CartItem::with('variant.product.images')->where('customer_id', $customer->id)->get();

        return response()->json([
            'success' => true,
            'message' => "Product updated successfully",
            'data' => $cart
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CartItem $cartItem
     *
     * @return [type]
     *
     */
    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        $customer = Auth::guard('api-customer')->user();
        $cart = CartItem::with('variant.product.images')->where('customer_id', $customer->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
            'data' => $cart
        ], Response::HTTP_OK);
    }
}
