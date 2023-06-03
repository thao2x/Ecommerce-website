<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shipping;

class ShippingController extends Controller
{
    public function index()
    {
        $shippings = Shipping::where('del_flg', 0)->get();

        return response()->json([
            'success' => true,
            'data' => $shippings
        ], 200);
    }
}
