@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Giảm giá</h1>
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
                        <a class="nav-link justify-content-center" href="{{route('promo.create')}}">
                            <span>Tạo ưu đãi giảm giá</span>
                        </a>
                    </li>
                </ul>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Phần trăm</th>
                            <th scope="col">Đã sử dụng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promoList as $promo)
                            @if ($promo->del_flg == 0)
                                <tr>
                                    <td scope="col" class="text-primary">
                                        <a class="ps-3" href="{{ route('promo.show', $promo->id) }}">{{ $promo->name }}</a>
                                    </td>
                                    <td scope="col">
                                        {{ $promo->description }}
                                    </td>
                                    <td scope="col">
                                        {{ $promo->percentage }}
                                        <i class="bi bi-percent"></i>
                                    </td>
                                    <td scope="col">
                                        {{ $promo->orders->count() }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                {{ $promoList->links('vendor.pagination.custom') }}
            </div>

        </div>
    </div><!-- End Recent Sales -->
@endsection
