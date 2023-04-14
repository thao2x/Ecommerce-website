@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Chỉnh sửa vận chuyển</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ $promo->name }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
<form action="{{ route('promo.update', $promo->id) }}" method="POST">
    @csrf
    @method('patch')
    <input type="hidden" name="id" value="{{$promo->id}}">
    <div class="row">
        <div class="col-8">
            <div class="card py-4 px-3 rounded">
                <div class="card-body p-0">
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input type="text" class="form-control py-2 mt-2" id="name" name="name" value="{{$promo->name}}" autocomplete="off" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control py-2 mt-2" id="description" rows="3" name="description" autocomplete="off" required>{{$promo->description}}</textarea>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="percentage">Phần trăm</label>                            
                                <input type="number" class="form-control py-2 mt-2" id="percentage" value="{{$promo->percentage}}" name="percentage" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="published_at">Ngày bắt đầu</label>                            
                                <input type="date" class="form-control py-2 mt-2" id="published_at" value="{{$promo->published_at}}" name="published_at" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>        

                {{-- Actions --}}
                <div class="d-flex justify-content-end pt-3">
                    <a href="{{ route('promo.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                    <a href="{{ route('promo.destroy', $promo->id) }}" class="btn btn-outline-danger ms-2">Xóa mã giảm giá</a>
                    <button type="submit" class="btn btn-success ms-2">Chỉnh sửa</button>
                </div>  
            </div>
        </div>
        <div class="col-4">
            <div class="card py-4 px-3 rounded">
                <div class="card-body p-0">
                    <div class="border-bottom">
                        <b>Tóm tắt</b>
                        <div class="p-o m-0 mt-3 d-flex justify-content-between align-items-center">
                            <b>{{ $promo->name }}</b>
                            <span class="badge bg-success py-3 px-4">Đang hoạt động</span>
                        </div>

                        <div class="mt-3">
                            <p class="p-o m-0">Chi tiết</p>
                            <ul>
                                <li>
                                    Tất cả khách hàng
                                </li>
                                <li>
                                    Không có giới hạn sử dụng
                                </li>
                                <li>
                                    Không thể kết hợp với các ưu đãi giảm giá khác
                                </li>
                                <li>
                                    Không có yêu cầu mua tối thiểu
                                </li>
                                <li>
                                    Có hiệu lực từ {{ $promo->published_at }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3">
                        <b>Hiệu suất</b>
                        <ul class="mt-2">
                            <li>
                                Đã sử dụng {{ $promo->orders->count() }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</form>
@endsection
