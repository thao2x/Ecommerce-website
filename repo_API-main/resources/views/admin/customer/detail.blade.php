@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Khách hàng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ $customer->nick_name }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="card mb-0">
                    <div class="card-body p-0 py-3 px-2 rounded">
                        <div class="row">
                            <div class="col-6 d-flex flex-column">
                                <span>Số tiền đã chi tiêu</span>
                                <span>
                                    @php
                                        $totalAll = 0;

                                        foreach($customer->orders as $order) {
                                            $totalOrder = 0;
                                            foreach($order->order_items as $item) {
                                                // Cộng tiền mỗi sản phẩm
                                                $totalOrder += ($item->variant->product->price * $item->quantity);
                                            }

                                            // Cộng mỗi đơn hàng
                                            $totalAll += $totalOrder;

                                            // Trừ tiền cho mỗi đơn hàng theo mã giảm giá
                                            $totalAll -= ($order->promo->percentage/100 * $totalOrder);

                                            // Cộng tiền ship cho mỗi đơn hàng
                                            $totalAll += $order->shipping->price;
                                        }
                                    @endphp

                                    {{ $totalAll }}<i class="bi bi-currency-dollar"></i>
                                </span>
                            </div>
                            <div class="col-6 d-flex flex-column border-start">
                                <span>Đơn hàng</span>
                                <span>{{ $customer->orders->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="card">
                    <div class="card-body p-0 py-3 px-2 rounded">
                        <b>Đơn đặt hàng mới nhất</b>
                        <div class="py-2">
                            <div class="row">
                                <div class="col-8 d-flex align-items-center">
                                    <a class="text-primary" href="{{ route('admin.order.show', $customer->orders->last()->id) }}">#{{$customer->orders->last()->code}}</a>
                                    @if ($customer->orders->last()->status == 1)
                                        <span class="badge bg-info px-3 py-2 ms-3">Chưa xử lý</span>
                                    @elseif ($customer->orders->last()->status == 2)
                                        <span class="badge bg-success px-3 py-2 ms-3">Đã xử lý</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2 ms-3">Đã hủy</span>
                                    @endif  
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    @php
                                        $total = 0;

                                        foreach($customer->orders->last()->order_items as $item) {
                                            // Cộng tiền mỗi sản phẩm
                                            $total += ($item->variant->product->price * $item->quantity);
                                        }
                                        
                                        // Trừ tiền cho mỗi đơn hàng theo mã giảm giá
                                        $total -= ($customer->orders->last()->promo->percentage/100 * $total);

                                        // Cộng tiền ship cho mỗi đơn hàng
                                        $total += $customer->orders->last()->shipping->price;

                                    @endphp

                                    {{ $total }} <i class="bi bi-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                        @foreach ($customer->orders->last()->order_items as $item)
                            <div class="row pt-4 border-top">
                                <div class="col-6 d-flex justify-content-start align-items-center">
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
                        
                        <div class="d-flex justify-content-end pt-2">
                            <a href="{{ route('admin.order.index', array('customer_id' => $customer->id)) }}" class="btn btn-outline-primary">Xem tất cả đơn hàng</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <ul class="sidebar-nav p-3">
                    <li class="nav-item">
                        <a class="nav-link w-content p-2 mb-3">Thông tin liên hệ</a>
                        <div class="row p-1 m-0">
                            <b class="col-4">Tên: </b>
                            <span  class="col-8">{{ $customer->full_name }}</span>
                        </div>
                        <div class="row p-1 m-0">
                            <b class="col-4">Biệt danh: </b>
                            <span  class="col-8">{{ $customer->nick_name }}</span>
                        </div>
                        <div class="row p-1 m-0">
                            <b class="col-4">Ngày sinh: </b>
                            <span  class="col-8">{{ $customer->dob }}</span>
                        </div>
                        <div class="row p-1 m-0">
                            <b class="col-4">Giới tính: </b>
                            <span  class="col-8">{{ $customer->gender }}</span>
                        </div>
                        <div class="row p-1 m-0">
                            <b class="col-4">Email: </b>
                            <span  class="col-8">{{ $customer->email }}</span>
                        </div>
                        <div class="row p-1 m-0">
                            <b class="col-4">SĐT: </b>
                            <span  class="col-8">{{ $customer->phone }}</span>
                        </div>
                    </li>
                </ul>
                <ul class="sidebar-nav p-3">
                    @foreach ($customer->shipping_address as $address)
                        {{-- Chỉ hiển thị địa chỉ mặc định default_flg: 1 --}}
                        @if ($address->default_flg == 1)
                            <li class="nav-item">
                                <a class="nav-link w-content p-2 mb-3">Địa chỉ giao hàng</a>
                                <div class="row p-1 m-0">
                                    <b class="col-4">Địa chỉ: </b>
                                    <span  class="col-8">{{ $address->name }}</span>
                                </div>
                                <div class="row p-1 m-0">
                                    <b class="col-4">Chi tiết: </b>
                                    <span  class="col-8">{{ $address->details }}</span>
                                </div>
                            </li>                            
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
