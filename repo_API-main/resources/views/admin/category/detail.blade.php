@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Chỉnh sửa bộ sưu tập</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <style>
        .content-image {
            height: 180px;
            border: 1px dashed gray;
            border-radius: 5px;
        }

        .content-image img {
            max-width: 100%;
            max-height: 100%;
            margin: 0 auto;
            display: block;
        }
    </style>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('patch')
        <input type="hidden" name="id" value="{{$category->id}}">
        <div class="row">
            <div class="col-8">
                <div class="card py-4 px-3 rounded">
                    <div class="card-body p-0">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control py-2 mt-2" id="name" name="name" value="{{ $category->name }}" autocomplete="off" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control py-2 mt-2" rows="3" name="description" autocomplete="off" required>{{ $category->description }}</textarea>
                        </div>
                    </div>        

                    {{-- Actions --}}
                    <div class="d-flex  justify-content-end pt-3">
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                        <a href="{{ route('categories.destroy', $category->id) }}" class="btn btn-outline-danger ms-2">Xóa bộ sưu tập</a>
                        <button type="submit" class="btn btn-success ms-2">Chỉnh sửa</button>
                    </div>  
                </div>
            </div>
            <div class="col-4">
                <div class="card py-4 px-3 rounded">
                    <div class="card-body p-0">
                        <div class="form-group">
                            <label for="title">Hình ảnh</label>
                            <input type="text" id="image" class="form-control py-2 mt-2" name="image" value="{{ $category->image }}" autocomplete="off" required>
                            <div class="content-image mt-3">
                                <img id="loadImg" src="{{ $category->image }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </form>

    <script>
        $(document).ready(function () {
            $('#image').change(function() {
                let src = $(this).val();
                $('#loadImg').attr('src', src);
            });
        })
    </script>
@endsection
