<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Promo;
use Yajra\Datatables\Datatables;

class PromoController extends Controller
{
    public function index()
    {
        return view('admin.promo');
    }

    public function data()
    {
        $promo = Promo::with('orders')->orderBy('created_at', 'DESC')->where('del_flg', 0)->get();

        return Datatables::of($promo)->make();
    }
    public function create()
    {
        return view('admin.promo-create');
    }

    public function store(Request $request)
    {
        Promo::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'percentage' => $request['percentage'],
            'published_at' => $request['published_at']
        ]);

        return redirect()->route('admin.promo.index');
    }

    public function show(string $promoId)
    {
        $promo = Promo::findOrFail($promoId);

        return view('admin.promo-detail', [
            'promo' => $promo
        ]);
    }

    public function update(Request $request, string $promoId)
    {
        Promo::findOrFail($promoId)->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'percentage' => $request['percentage'],
            'published_at' => $request['published_at']
        ]);

        // Lấy lại danh sách promos mới nhất
        $promos = Promo::orderBy('created_at', 'DESC')->where('del_flg', 0)->get();

        return redirect()->route('admin.promo.index');
    }

    public function destroy(string $promoId)
    {
        Promo::findOrFail($promoId)->update(['del_flg' => 1]);

        return redirect()->route('admin.promo.index');
    }
}
