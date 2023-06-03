<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customer');
    }

    public function data()
    {
        $currentYear = Carbon::now();
        $prevYear = Carbon::now()->subYears(1);

        $customer = Customer::with(['orders' => fn($query) => $query->whereYear('created_at', '<=', $currentYear)->whereYear('created_at', '>=', $prevYear)])->where('del_flg', 0)->get();
        return Datatables::of($customer)->make();
    }

    public function dataOrder(string $customerId)
    {
        $currentYear = Carbon::now();
        $prevYear = Carbon::now()->subYears(1);

        $orders = Order::with('customer', 'promo', 'orderItems.variant.product', 'shipping')->where('customer_id', $customerId)->whereYear('created_at', '<=', $currentYear)->whereYear('created_at', '>=', $prevYear)->where('del_flg', 0)->get();
        return Datatables::of($orders)->make();
    }

    public function show(string $customerId)
    {
        $customer = Customer::findOrFail($customerId);

        return view('admin.customer-detail', [
            'customer' => $customer
        ]);
    }

    public function destroy(string $customerId)
    {
        Customer::findOrFail($customerId)->update(['del_flg' => 1]);

        return redirect()->route('admin.customer.index');
    }
}
