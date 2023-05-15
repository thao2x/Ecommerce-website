<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping_address;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index()
    {
        $customer = \Auth::guard('api-customer')->user();
        $address = Shipping_address::where('customer_id', $customer->id)->first();

        return response()->json([
            'success' => true,
            'data' => $address
        ], 200);
    }

    public function store(Request $request)
    {
        $customer = \Auth::guard('api-customer')->user();
        $item = Shipping_address::where('customer_id', $customer->id)->first();

        if ($item == null) {
            Shipping_address::create([
                'customer_id' => $customer->id,
                'name' => $request['name'],
                'details' => $request['details'],
                'default_flg' => 1
            ]);
        } else {
            $item->update([
                'name' => $request['name'],
                'details' => $request['details'],
            ]);
        }
        
        $address = Shipping_address::where('customer_id', $customer->id)->first();

        return response()->json([
            'success' => true,
            'data' => $address
        ], 200);
    }
}
