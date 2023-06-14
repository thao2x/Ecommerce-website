<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Carbon\Carbon;

class PromoController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now();
        $promos = Promo::where('del_flg', 0)->where('published_at', '<=', $currentDate)->get();

        return response()->json([
            'success' => true,
            'data' => $promos
        ], 200);
    }
}
