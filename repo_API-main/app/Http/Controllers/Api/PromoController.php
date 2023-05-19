<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $data = Promo::all();

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }
}
