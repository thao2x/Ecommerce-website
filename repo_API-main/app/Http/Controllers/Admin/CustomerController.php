<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(Request $request) {
        $customers = Customer::where(function($query) use ($request) {
            if ($request->has('query')) {
                $query->where('nick_name', 'LIKE', '%'.$request['query'].'%')
                            ->orWhere('email', 'LIKE', '%'.$request['query'].'%');
            }
        })->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.customer.index', [
            'customers' => $customers,
            'query_prev' =>  $request['query']
        ]);
    }

    public function show($id) {
        $customer = Customer::findOrFail($id);

        return view('admin.customer.detail', [
            'customer' => $customer
        ]);
    }
}
