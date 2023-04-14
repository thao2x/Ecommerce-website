<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promo;

class PromoController extends Controller
{
    public function index() {
        $promoList = Promo::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.promo.index', [
            'promoList' => $promoList
        ]);
    }

    public function show($id) {
        $promo = Promo::findOrFail($id);

        return view('admin.promo.detail', [
            'promo' => $promo
        ]);
    }

    public function create() {
        return view('admin.promo.create', []);
    }

    public function store(Request $request) {
        $data = $request->all();
        Promo::create($data);

        $promoList = Promo::orderBy('created_at', 'DESC')->paginate(10);
        
        return view('admin.promo.index', [
            'promoList' => $promoList
        ]);
    }

    public function update(Request $request) {
        $data = $request->all();

        Promo::findOrFail($data['id'])->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'percentage' => $data['percentage'],
            'published_at' => $data['published_at']
        ]);

        $promoList = Promo::orderBy('created_at', 'DESC')->paginate(10);
        
        return view('admin.promo.index', [
            'promoList' => $promoList
        ]);
    }

    public function destroy($id) {
        Promo::findOrFail($id)->update(['del_flg' => 1]);
        $promoList = Promo::orderBy('created_at', 'DESC')->paginate(10);
        
        return view('admin.promo.index', [
            'promoList' => $promoList
        ]);
    }
}
