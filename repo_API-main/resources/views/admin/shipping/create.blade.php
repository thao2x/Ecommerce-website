@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Tạo vận chuyển</h1>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <form action="{{ route('shipping.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
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
                        <div class="form-group mt-3">
                            <label for="price">Phí vận chuyển</label>                            
                            <input type="number" class="form-control py-2 mt-2" id="price" name="price" autocomplete="off" required>
                        </div>
                    </div>        

                    {{-- Actions --}}
                    <div class="d-flex  justify-content-end pt-3">
                        <a href="{{ route('shipping.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-success ms-2">Thêm mới</button>
                    </div>  
                </div>
            </div>
        </div> 
    </form>
@endsection
