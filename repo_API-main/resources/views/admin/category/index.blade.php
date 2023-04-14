@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Danh bộ sưu tập</h1>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <style>
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
                <ul class="sidebar-nav pt-3 d-flex justify-content-between">
                    <li class="nav-item col-1">
                        <a class="nav-link justify-content-center">
                            <span>Tất cả</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link justify-content-center" href="{{route('categories.create')}}">
                            <span>Thêm mới</span>
                        </a>
                    </li>
                </ul>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Thời gian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            @if ($category->del_flg == 0)
                                <tr>
                                    <td scope="col" class="text-primary">
                                        <div class="position-relative">
                                            @if ($category->image)
                                                <img class="img-product" src="{{ $category->image }}">
                                            @else
                                                <img class="img-product" src="https://media.istockphoto.com/id/931643150/vector/picture-icon.jpg?s=170667a&w=0&k=20&c=3Jh8trvArKiGdBCGPfe6Y0sUMsfh2PrKA0uHOK4_0IM=">
                                            @endif
                                            <a class="ps-3" href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        {{ $category->products->count() }}
                                    </td>
                                    <td scope="col">
                                        {{ $category->created_at }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                {{ $categories->links('vendor.pagination.custom') }}
            </div>

        </div>
    </div><!-- End Recent Sales -->
@endsection
