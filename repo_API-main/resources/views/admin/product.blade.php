@extends('layout.app')
@section('title')
    <div class="pagetitle">
        <h1>Sản phẩm</h1>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="d-flex justify-content-between my-3">
                    <form method="get" action="{{ route('admin.product.index') }}">
                        <div class="form-group has-search d-flex justify-content-between">
                            <input type="text" class="form-control ms-2" name="query" value="{{ $query_prev }}" placeholder="Tìm kiếm">
                            <button type="submit" class="btn btn-outline-secondary ms-2"><i class="bi bi-search"></i></button>
                        </div>
                    </form>                    
                    <a class="btn btn-success w-auto" href="{{route('admin.product.store')}}">
                        <span>Thêm mới</span>
                    </a>
                </div>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Sảm phẩm</th>
                            <th scope="col">Loại</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Ngày thêm</th>
                            <th scope="col">Người thêm</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            @if ($product->del_flg == 0 && $product->name)
                                <tr>
                                    <td scope="col" class="text-primary">
                                        <div class="position-relative">
                                            @if (count($product->images) > 0)
                                                <img class="img-product" src="{{ config('APP_URL') . '/storage' . $product->images[0]->src }}">
                                            @else
                                                <img class="img-product" src="https://media.istockphoto.com/id/931643150/vector/picture-icon.jpg?s=170667a&w=0&k=20&c=3Jh8trvArKiGdBCGPfe6Y0sUMsfh2PrKA0uHOK4_0IM=">
                                            @endif
                                            <a class="ps-3" href="{{ route('admin.product.show', $product->id) }}">{{ $product->name }}</a>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        @if ($product->type == 1)
                                            <span class="badge bg-secondary">Nháp</span>
                                        @else
                                            <span class="badge bg-success">Đang hoạt động</span>
                                        @endif
                                    </td>
                                    <td scope="col">
                                        {{ $product->price }} 
                                        <i class="bi bi-currency-dollar"></i>
                                    </td>
                                    <td scope="col">
                                        {{ $product->created_at }}
                                    </td>
                                    <td scope="col">
                                        {{ $product->user->full_name }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                {{ $products->links('vendor.pagination.custom') }}
            </div>

        </div>
    </div>
@endsection
