@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Tạo ưu đãi giảm giá đơn hàng</h1>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <form action="{{ route('promo.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-8">
                <div class="card py-4 px-3 rounded">
                    <div class="card-body p-0">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control py-2 mt-2" id="name" name="name" autocomplete="off" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control py-2 mt-2" id="description" rows="3" name="description" autocomplete="off" required></textarea>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="percentage">Phần trăm</label>                            
                                    <input type="number" class="form-control py-2 mt-2" id="percentage" name="percentage" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="published_at">Ngày bắt đầu</label>                            
                                    <input type="date" class="form-control py-2 mt-2" id="published_at" name="published_at" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                    </div>        

                    {{-- Actions --}}
                    <div class="d-flex justify-content-end pt-3">
                        <a href="{{ route('promo.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-success ms-2">Thêm mới</button>
                    </div>  
                </div>
            </div>
            <div class="col-4">
                <div class="card py-4 px-3 rounded">
                    <div class="card-body p-0">
                        <div class="border-bottom">
                            <b>Tóm tắt</b>
                            <p class="p-o m-0 mt-3">Chưa có mã giảm giá nào.</p>

                            <div class="mt-3">
                                <p class="p-o m-0">Chi tiết</p>
                                <ul>
                                    <li>
                                        Không thể kết hợp với các ưu đãi giảm giá khác
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-3">
                            <b>Hiệu suất</b>
                            <p class="p-o m-0 mt-3">Giảm giá chưa được kích hoạt.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </form>
@endsection
