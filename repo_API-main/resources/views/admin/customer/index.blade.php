@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Khách hàng</h1>
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

    .img-product {
        width: 42px;
        height: 42px;
        border-radius: 5px;
        border: 1px solid #cacaca;
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
                    <form method="get" action="{{ route('admin.customer.index') }}">
                        <div class="form-group has-search d-flex justify-content-between">
                                <input type="text" class="form-control me-2" name="query" value="{{ $query_prev }}" placeholder="Tìm kiếm">
                                <button type="submit" class="btn btn-outline-secondary me-3"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Email</th>
                            <th scope="col">Địa điểm</th>
                            <th scope="col">Đơn hàng</th>
                            <th scope="col">Số tiền đã chi tiêu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            @if ($customer->del_flg == 0)
                                <tr>
                                    <td scope="col" class="text-primary">
                                        <div class="position-relative">
                                            @if ($customer->avatar)
                                                <img class="img-product" src="{{ $customer->avatar }}">
                                            @else
                                                <img class="img-product" src="https://media.istockphoto.com/id/931643150/vector/picture-icon.jpg?s=170667a&w=0&k=20&c=3Jh8trvArKiGdBCGPfe6Y0sUMsfh2PrKA0uHOK4_0IM=">
                                            @endif
                                            <a class="ps-3" href="{{ route('admin.customer.show', $customer->id) }}">{{ $customer->nick_name }}</a>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        {{ $customer->email }}
                                    </td>
                                    <td scope="col">
                                        @foreach ($customer->shipping_address as $address)
                                            @if ($address->default_flg == 1)
                                                {{ $address->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td scope="col">
                                        {{ $customer->orders->count() }} đơn hàng
                                    </td>
                                    <td scope="col">
                                        @php
                                            $total = 0;

                                            foreach($customer->orders as $order) {
                                                $totalOrder = 0;
                                                foreach($order->order_items as $item) {
                                                    // Cộng tiền mỗi sản phẩm
                                                    $totalOrder += ($item->variant->product->price * $item->quantity);
                                                }

                                                // Cộng mỗi đơn hàng
                                                $total += $totalOrder;

                                                // Trừ tiền cho mỗi đơn hàng theo mã giảm giá
                                                $total -= ($order->promo->percentage/100 * $totalOrder);

                                                // Cộng tiền ship cho mỗi đơn hàng
                                                $total += $order->shipping->price;
                                            }
                                        @endphp

                                        {{ $total }}<i class="bi bi-currency-dollar"></i>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                {{ $customers->links('vendor.pagination.custom') }}
            </div>

        </div>
    </div><!-- End Recent Sales -->
@endsection
