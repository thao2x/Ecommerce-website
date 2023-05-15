<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::orderBy('created_at', 'DESC')->get();

        return view('admin.promo.index', [
            'promos' => $promos
        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Trường tiêu đề là bắt buộc.',
            'description.required' => 'Trường mô tả là bắt buộc.',
            'percentage.required' => 'Trường giá vận chuyển là bắt buộc.',
            'published_at.required' => 'Ngày phát hành là bắt buộc.'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'percentage' => 'required',
            'published_at' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ], 200);
        }

        Promo::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'percentage' => $request['percentage'],
            'published_at' => $request['published_at']
        ]);

        $promos = Promo::orderBy('created_at', 'DESC')->get();

        return response()->json([
            'success' => true,
            'data' => $promos
        ], 200);
    }

    public function show(string $promoId)
    {
        $category = Promo::findOrFail($promoId);

        return response()->json([
            'success' => true,
            'data' => $category
        ], 200);
    }

    public function update(Request $request, string $promoId)
    {
        $messages = [
            'name.required' => 'Trường tiêu đề là bắt buộc.',
            'description.required' => 'Trường mô tả là bắt buộc.',
            'percentage.required' => 'Trường giá vận chuyển là bắt buộc.',
            'published_at.required' => 'Ngày phát hành là bắt buộc.'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'percentage' => 'required',
            'published_at' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ], 200);
        }        

        Promo::findOrFail($promoId)->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'percentage' => $request['percentage'],
            'published_at' => $request['published_at']
        ]);

        // Lấy lại danh sách promos mới nhất
        $promos = Promo::orderBy('created_at', 'DESC')->get();

        return response()->json([
            'success' => true,
            'data' => $promos
        ], 200);
    }

    public function destroy(string $promoId)
    {
        Promo::findOrFail($promoId)->update(['del_flg' => 1]);
        $promos = Promo::orderBy('created_at', 'DESC')->get();

        return response()->json([
            'success' => true,
            'data' => $promos
        ], 200);
    }
}
