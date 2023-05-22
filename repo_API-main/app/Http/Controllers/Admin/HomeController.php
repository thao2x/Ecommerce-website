<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class HomeController extends Controller
{
    public function index() {
        $total = Order::count();
        $total_no_process = Order::where('status', 1)->count();
        $total_processed = Order::where('status', 2)->count();
        $total_cancelled = Order::where('status', 0)->count();

        return view('admin.home', [
            'total' => $total,
            'total_no_process' => $total_no_process,
            'total_processed' => $total_processed,
            'total_cancelled' => $total_cancelled
        ]);
    }
}
