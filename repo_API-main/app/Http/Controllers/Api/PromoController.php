<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::where('del_flg', 0)->get();

        return response()->json([
            'success' => true,
            'data' => $promos
        ], 200);
    }
}
