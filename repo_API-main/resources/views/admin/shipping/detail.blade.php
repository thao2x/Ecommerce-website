@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Chỉnh sửa vận chuyển</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ $shipping->name }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <form action="{{ route('shipping.update', $shipping->id) }}" method="POST">
        @csrf
        @method('patch')
        <input type="hidden" name="id" value="{{$shipping->id}}">
        <div class="row">
            <div class="col-12">
                <div class="card py-4 px-3 rounded">
                    <div class="card-body p-0">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control py-2 mt-2" id="name" name="name" value="{{ $shipping->name }}" autocomplete="off" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control py-2 mt-2" id="description" rows="3" name="description" autocomplete="off" required>{{ $shipping->description }}</textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="price">Phí vận chuyển</label>                            
                            <input type="number" class="form-control py-2 mt-2" id="price" name="price" value="{{ $shipping->price }}" autocomplete="off" required>
                        </div>
                    </div>        

                    {{-- Actions --}}
                    <div class="d-flex  justify-content-end pt-3">
                        <a href="{{ route('shipping.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                        <a href="{{ route('shipping.destroy', $shipping->id) }}" class="btn btn-outline-danger ms-2">Xóa vận chuyển</a>
                        <button type="submit" class="btn btn-success ms-2">Chỉnh sửa</button>
                    </div>  
                </div>
            </div>
        </div> 
    </form>
@endsection
