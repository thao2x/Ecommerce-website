@extends('layout.app')
@section('title')
    <div class="pagetitle">
        <h1>Đơn hàng</h1>
    </div><!-- End Page Title -->
@endsection

@section('content')
<style>
    .datatable-top {
        display: none
    }
    .datatable-bottom {
        display: none
    }
</style>
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">

            <div class="card-body">
                <div class="d-flex justify-content-between my-3">
                    <a class="btn btn-primary disabled ms-2">
                        <span>Tất cả</span>
                    </a>
                    <form method="get" action="{{ route('admin.order.index') }}">
                        <div class="form-group has-search d-flex justify-content-between">
                                <input type="text" class="form-control me-2" name="query" value="{{ $query_prev }}" placeholder="Tìm kiếm">
                                <button type="submit" class="btn btn-outline-secondary me-3"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Đơn hàng</th>
                            <th scope="col">Ngày</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Tổng</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Mặt hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td scope="col" class="text-primary">
                                    <a href="{{ route('admin.order.show', $order->id) }}">#{{ $order->code }}</a>
                                </td>
                                <td scope="col">{{ $order->created_at }}</td>
                                <td scope="col">{{ $order->customer->full_name }}</td>
                                <td scope="col">
                                    @php
                                        $total = 0;

                                        foreach($order->orderItems as $item) {
                                            // Cộng tiền mỗi sản phẩm
                                            $total += ($item->variant->product->price * $item->quantity);
                                        }
                                        
                                        // Trừ tiền cho mỗi đơn hàng theo mã giảm giá
                                        $total -= ($order->promo->percentage/100 * $total);

                                        // Cộng tiền ship cho mỗi đơn hàng
                                        $total += $order->shipping->price;

                                    @endphp

                                    {{ $total }} <i class="bi bi-currency-dollar"></i>
                                </td>
                                <td scope="col">
                                    @if ($order->status == 1)
                                        <span class="badge bg-info ">Chưa xử lý</span>
                                    @elseif ($order->status == 2)
                                        <span class="badge bg-success">Đã xử lý</span>
                                    @else
                                        <span class="badge bg-danger">Đã hủy</span>
                                    @endif                                    
                                </td>
                                <td scope="col">{{ $order->orderItems->count() }} mặt hàng</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $orders->links('vendor.pagination.custom') }}
            </div>

        </div>
    </div><!-- End Recent Sales -->
@endsection
