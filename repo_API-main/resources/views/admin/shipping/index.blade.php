@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Vận chuyển</h1>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">

            <div class="card-body">
                <ul class="sidebar-nav pt-3 d-flex justify-content-between">
                    <li class="nav-item col-1">
                        <a class="nav-link justify-content-center">
                            <span>Tất cả</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link justify-content-center" href="{{route('shipping.create')}}">
                            <span>Thêm mới</span>
                        </a>
                    </li>
                </ul>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Phí vận chuyển</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shippings as $shipping)
                            @if ($shipping->del_flg == 0)
                                <tr>
                                    <td scope="col" class="text-primary">
                                        <a class="ps-3" href="{{ route('shipping.show', $shipping->id) }}">{{ $shipping->name }}</a>
                                    </td>
                                    <td scope="col">
                                        {{ $shipping->description }}
                                    </td>
                                    <td scope="col">
                                        {{ $shipping->price }}
                                        <i class="bi bi-currency-dollar"></i>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                {{ $shippings->links('vendor.pagination.custom') }}
            </div>

        </div>
    </div><!-- End Recent Sales -->
@endsection
