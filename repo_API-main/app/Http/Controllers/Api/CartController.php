<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart_Item;

class CartController extends Controller
{
    public function index()
    {
        $customer = \Auth::guard('api-customer')->user();
        $cartItems = Cart_Item::with('variant.product.images')->where('customer_id', $customer->id)->get();
        
        return response()->json([
            'success' => true,
            'data' => $cartItems
        ], 200);
    }

    public function update(Request $request, string $itemId)
    {
        // Update data
        Cart_Item::find($itemId)->update([
            'quantity' => $request['quantity']
        ]);
        
        $customer = \Auth::guard('api-customer')->user();
        $cartItems = Cart_Item::with('variant.product.images')->where('customer_id', $customer->id)->get();
        
        return response()->json([
            'success' => true,
            'data' => $cartItems
        ], 200);
    }

    public function store(Request $request)
    {                
        $customer = \Auth::guard('api-customer')->user();
        $item = Cart_Item::where('variant_id',  $request['variant_id'])->where('customer_id', $customer->id)->first();

        if ($item == null) {
            Cart_Item::create([
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

        $cartItems = Cart_Item::with('variant.product.images')->where('customer_id', $customer->id)->get();
        
        return response()->json([
            'success' => true,
            'data' => $cartItems
        ], 200);
    }

    public function destroy(string $itemId)
    {
        // Delete data
        Cart_Item::find($itemId)->delete();
        
        $customer = \Auth::guard('api-customer')->user();
        $cartItems = Cart_Item::with('variant.product.images')->where('customer_id', $customer->id)->get();
        
        return response()->json([
            'success' => true,
            'data' => $cartItems
        ], 200);
    }
}
