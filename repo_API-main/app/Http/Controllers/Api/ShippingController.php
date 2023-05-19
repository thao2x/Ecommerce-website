<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shipping;

class ShippingController extends Controller
{
    public function index()
    {
        $data = Shipping::all();

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }
}
