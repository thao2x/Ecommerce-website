@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Đơn hàng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">#{{ $order->code }}</li>
            </ol>
        </nav>
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
        }

        .w-content {
            width: fit-content
        }
    </style>
    <div class="row">
        <div class="col-8">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <ul class="sidebar-nav pt-3">
                        <li class="nav-item">
                            <a class="nav-link w-content justify-content-center p-2">
                                <span>Sản phẩm</span>
                            </a>
                        </li>
                    </ul>
                    
                    <div class="pt-2">
                        @foreach ($order->order_items as $item)
                            <div class="row pt-4">
                                <div class="col-6  d-flex justify-content-start align-items-center">
                                    <div class="position-relative">
                                        @if (count($item->variant->product->images) > 0)
                                            <img class="img-product" src="{{ $item->variant->product->images[0]->src }}">
                                        @else
                                            <img class="img-product" src="https://media.istockphoto.com/id/931643150/vector/picture-icon.jpg?s=170667a&w=0&k=20&c=3Jh8trvArKiGdBCGPfe6Y0sUMsfh2PrKA0uHOK4_0IM=">
                                        @endif
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ $item->quantity }}
                                        </span>
                                    </div>
                                    <span class="ps-3">{{ $item->variant->product->name }}</span>
                                </div>
                                <div class="col-3 d-flex justify-content-end align-items-center">
                                    {{ $item->variant->product->price }} <i class="bi bi-currency-dollar"></i> × {{ $item->quantity }}
                                </div>
                                <div class="col-3 d-flex justify-content-end align-items-center">
                                    {{ $item->quantity * $item->variant->product->price }} <i class="bi bi-currency-dollar"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card recent-sales overflow-auto">
                <div class="card-body pb-0">
                    <ul class="sidebar-nav pt-3">
                        <li class="nav-item">
                            <a class="nav-link w-content justify-content-center p-2" href="#">
                                <span>Thanh toán</span>
                            </a>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-3">
                            <p class="p-1 m-0">Tổng phụ</p>
                            <p class="p-1 m-0">Vận chuyển</p>
                            <p class="p-1 m-0">Giảm giá</p>
                            <p class="p-1 m-0"><b>Tổng</b></p>
                        </div>
                        <div class="col-3">
                            <p class="p-1 m-0">{{ $order->order_items->count() }} mặt hàng</p>
                            <p class="p-1 m-0">STANDARD </p>
                            <p class="p-1 m-0">
                                {{ $order->promo->name}}
                                ({{ $order->promo->percentage}}<i class="bi bi-percent"></i>)
                            </p>
                        </div>
                        <div class="col-6">                            
                            @php
                                $total = 0;

                                foreach($order->order_items as $item) {
                                    // Cộng tiền mỗi sản phẩm
                                    $total += ($item->variant->product->price * $item->quantity);
                                }
                            @endphp

                            <p class="p-1 mb-0 text-end">{{ $total }} <i class="bi bi-currency-dollar"></i></p>
                            <p class="p-1 mb-0 text-end">
                                {{ $order->shipping->price }} <i class="bi bi-currency-dollar"></i>
                            </p>
                            <p class="p-1 mb-0 text-end">
                                {{ $order->promo->percentage/100 * $total}} <i class="bi bi-currency-dollar"></i>
                            </p>
                            <p class="p-1 mb-0 text-end">
                                @php
                                    // Trừ tiền cho mỗi đơn hàng theo mã giảm giá
                                    $total -= ($order->promo->percentage/100 * $total);

                                    // Cộng tiền ship cho mỗi đơn hàng
                                    $total += $order->shipping->price;
                                @endphp

                                <b>{{ $total }} <i class="bi bi-currency-dollar"></i></b>
                            </p>
                        </div>
                        <div class="p-4 d-flex justify-content-end">
                            @if ($order->status == 1)
                                <form method="post" action="{{ route('orders.cancel', $order->id) }}">
                                    @method('patch')
                                    @csrf
                                    <button class="btn btn-outline-secondary me-3">Hủy đơn hàng</button>
                                </form>
                                <form method="post" action="{{ route('orders.update', $order->id) }}">
                                    @method('patch')
                                    @csrf
                                    <button class="btn btn-outline-primary">Duyệt đơn hàng</button>
                                </form>
                            @else
                                @if ($order->status == 3)
                                    <span class="badge bg-danger  px-4 py-2 fs-6">Đã hủy</span>
                                @else
                                    <span class="badge bg-success  px-4 py-2 fs-6">Đã xử lý</span>
                                @endif
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <ul class="sidebar-nav pt-3">
                        <li class="nav-item">
                            <a class="nav-link w-content p-2 mb-3" href="#">Thông tin liên hệ</a>
                            <div class="row p-1 m-0">
                                <b class="col-4">Tên: </b>
                                <span  class="col-8">{{ $order->customer->nick_name }}</span>
                            </div>
                            <div class="row p-1 m-0">
                                <b class="col-4">Email: </b>
                                <span  class="col-8">{{ $order->customer->email }}</span>
                            </div>
                            <div class="row p-1 m-0">
                                <b class="col-4">SĐT: </b>
                                <span  class="col-8">{{ $order->customer->phone }}</span>
                            </div>
                        </li>
                    </ul>
                    <ul class="sidebar-nav pt-3">
                        <li class="nav-item">
                            <a class="nav-link w-content p-2 mb-3" href="#">Địa chỉ giao hàng</a>
                            <div class="row p-1 m-0">
                                <b class="col-4">Địa chỉ: </b>
                                <span  class="col-8">{{ $order->shipping_address->name }}</span>
                            </div>
                            <div class="row p-1 m-0">
                                <b class="col-4">Chi tiết: </b>
                                <span  class="col-8">{{ $order->shipping_address->details }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
