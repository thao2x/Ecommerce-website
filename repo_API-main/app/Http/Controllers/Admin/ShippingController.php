<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends Controller
{
    public function index() {
        $shippings = Shipping::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.shipping.index', [
            'shippings' => $shippings
        ]);
    }

    public function show($id) {
        $shipping = Shipping::findOrFail($id);

        return view('admin.shipping.detail', [
            'shipping' => $shipping
        ]);
    }

    public function create() {
        return view('admin.shipping.create', []);
    }

    public function store(Request $request) {
        $data = $request->all();
        Shipping::create($data);

        $shippings = Shipping::orderBy('created_at', 'DESC')->paginate(10);
        
        return view('admin.shipping.index', [
            'shippings' => $shippings
        ]);
    }

    public function update(Request $request) {
        $data = $request->all();

        Shipping::findOrFail($data['id'])->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price']
        ]);

        $shippings = Shipping::orderBy('created_at', 'DESC')->paginate(10);
        
        return view('admin.shipping.index', [
            'shippings' => $shippings
        ]);
    }

    public function destroy($id) {
        Shipping::findOrFail($id)->update(['del_flg' => 1]);
        $shippings = Shipping::orderBy('created_at', 'DESC')->paginate(10);
        
        return view('admin.shipping.index', [
            'shippings' => $shippings
        ]);
    }
}
