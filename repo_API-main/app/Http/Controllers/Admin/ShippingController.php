<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Shipping;
use Yajra\Datatables\Datatables;

class ShippingController extends Controller
{
    public function index()
    {
        return view('admin.shipping');
    }

    public function data()
    {
        $shippings = Shipping::orderBy('created_at', 'DESC')->where('del_flg', 0)->get();

        return Datatables::of($shippings)->make();
    }

    public function create()
    {
        return view('admin.shipping-create');
    }

    public function store(Request $request)
    {
        Shipping::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price']
        ]);

        return redirect()->route('admin.shipping.index');
    }

    public function show(string $shippingId)
    {
        $shipping = Shipping::findOrFail($shippingId);

        return view('admin.shipping-detail', [
            'shipping' => $shipping
        ]);
    }

    public function update(Request $request, string $shippingId)
    {
        Shipping::findOrFail($shippingId)->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price']
        ]);

        return redirect()->route('admin.shipping.index');
    }

    public function destroy(string $shippingId)
    {
        Shipping::findOrFail($shippingId)->update(['del_flg' => 1]);

        return redirect()->route('admin.shipping.index');
    }
}
