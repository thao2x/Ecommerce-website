@extends('layout.app')

@section('content')
<div class="p-3 d-flex align-items-center justify-content-between pb-0">
    <div class="d-flex align-items-center">
        <a href="{{ route('admin.order.index') }}" class="text-secondary"><i class="bi bi-arrow-left"></i></a>
        <a href="{{ route('admin.order.index') }}" class="my-2 ms-2 fs-3 fw-bold title color--g">{{ $order->code }}</a>
    </div>
    <div>
        @if ($order->status == 0)
            <span class="badge badge-sm bg-gradient-secondary w-auto">Processing</span>
        @endif
        @if ($order->status == 1)
            <span class="badge badge-sm bg-gradient-success w-auto">Completed</span>
        @endif
        @if ($order->status == 2)
            <span class="badge badge-sm bg-gradient-cancel w-auto">Canceled</span>
        @endif
    </div>
</div>
<div class="row p-3 pt-0">
    <div class="col-7 p-3">
        <p class="fs-5 fw-bold m-0 color--g">Product List</p>
        <div>
            @foreach ($order->orderItems as $item)
            <div class="row pt-4">
                <div class="col-6  d-flex justify-content-start align-items-center">
                    <div class="position-relative">
                        @if (count($item->variant->product->images) > 0)
                        <img class="img-product"
                            src="{{ config('APP_URL') . '/storage' . $item->variant->product->images[0]->src }}">
                        @else
                        <img class="img-product"
                            src="https://media.istockphoto.com/id/931643150/vector/picture-icon.jpg?s=170667a&w=0&k=20&c=3Jh8trvArKiGdBCGPfe6Y0sUMsfh2PrKA0uHOK4_0IM=">
                        @endif
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $item->quantity }}
                        </span>
                    </div>
                    <span class="ps-3">{{ $item->variant->product->name }}</span>
                </div>
                <div class="col-3 d-flex justify-content-end align-items-center">
                    <i class="bi bi-currency-dollar"></i>{{ ($item->variant->product->price) }} ×
                    {{ $item->quantity }}
                </div>
                <div class="col-3 d-flex justify-content-end align-items-center">
                    <i class="bi bi-currency-dollar"></i>{{ ($item->quantity *
                    $item->variant->product->price) }}
                </div>
            </div>
            @endforeach
        </div>
        <p class="fs-5 fw-bold m-0 color--g mt-4 ">Payment</p>
        <div class="row mt-2">
            <div class="col-3">
                <p class="p-1 m-0">Subtotal</p>
                <p class="p-1 m-0">Shipping</p>
                <p class="p-1 m-0">Discount</p>
                <p class="p-1 m-0"><b>Total</b></p>
            </div>
            <div class="col-3">
                <p class="p-1 m-0">{{ $order->orderItems->count() }} products</p>
                <p class="p-1 m-0">{{ $order->shipping->name }}</p>
                <p class="p-1 m-0"> {{ $order->promo->name}} ({{ $order->promo->percentage}}<i class="bi bi-percent"></i>)</p>
            </div>
            <div class="col-6">
                @php
                    $total = 0;
                    foreach($order->orderItems as $item) {
                        // Cộng tiền mỗi sản phẩm
                        $total += ($item->variant->product->price * $item->quantity);
                    }
                @endphp

                <p class="p-1 mb-0 text-end">
                    <i class="bi bi-currency-dollar"></i>{{ ($total) }}
                </p>
                <p class="p-1 mb-0 text-end">
                    <i class="bi bi-currency-dollar"></i>{{ ($order->shipping->price) }}
                </p>
                <p class="p-1 mb-0 text-end">
                    <i class="bi bi-currency-dollar"></i>{{ ($order->promo->percentage/100 * $total) }}
                </p>

                <p class="p-1 mb-0 text-end">
                    @php
                        // Trừ tiền cho mỗi đơn hàng theo mã giảm giá
                        if (isset($order->promo)) {
                            $total -= ($order->promo->percentage/100 * $total);
                        }

                        // Cộng tiền ship cho mỗi đơn hàng
                        $total += $order->shipping->price;
                    @endphp

                    <b>
                        <i class="bi bi-currency-dollar"></i>{{ ($total) }}
                    </b>
                </p>
            </div>
            <div class="p-4 d-flex justify-content-end">
                @if ($order->status == 0)
                    <a href="{{ route('admin.order.update-canceled', $order->id) }}" class="btn btn-outline-danger me-3">Canceled</a>
                    <a href="{{ route('admin.order.update-completed', $order->id) }}" class="btn btn-outline-success">Completed</a>
                @endif
            </div>
        </div>

    </div>
    <div class="col-5 ps-5">
        <ul class="sidebar-nav pt-3">
            <li class="nav-item">
                <p class="fs-5 fw-bold m-0 mb-4 color--g">Contact</p>
                <div class="row p-1 m-0">
                    <span class="col-4">Name: </span>
                    <span class="col-8 fs-6 fw-bold">{{ $order->customer->nick_name }}</span>
                </div>
                <div class="row p-1 m-0">
                    <span class="col-4">Email: </span>
                    <span class="col-8 fs-6 fw-bold">{{ $order->customer->email }}</span>
                </div>
                <div class="row p-1 m-0">
                    <span class="col-4">Phone: </span>
                    <span class="col-8 fs-6 fw-bold">{{ $order->customer->phone }}</span>
                </div>
            </li>
        </ul>
        <ul class="sidebar-nav pt-3">
            <li class="nav-item">
                <p class="fs-5 fw-bold m-0 mb-4 color--g">Delivery addres</p>
                <div class="row p-1 m-0">
                    <span class="col-4">Address: </span>
                    <span class="col-8 fs-6 fw-bold">{{ $order->shippingAddress->name }}</span>
                </div>
                <div class="row p-1 m-0">
                    <span class="col-4">Details: </span>
                    <span class="col-8 fs-6 fw-bold">{{ $order->shippingAddress->details }}</span>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
