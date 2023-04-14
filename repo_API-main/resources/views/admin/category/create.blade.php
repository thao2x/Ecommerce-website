@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Tạo bộ sưu tập</h1>
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
    <form action="{{ route('categories.store') }}" method="POST">
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
                            <textarea class="form-control py-2 mt-2" rows="3" name="description" autocomplete="off" required></textarea>
                        </div>
                    </div>        

                    {{-- Actions --}}
                    <div class="d-flex  justify-content-end pt-3">
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-success ms-2">Thêm mới</button>
                    </div>  
                </div>
            </div>
            <div class="col-4">
                <div class="card py-4 px-3 rounded">
                    <div class="card-body p-0">
                        <div class="form-group">
                            <label for="title">Hình ảnh</label>
                            <input type="text" id="image" class="form-control py-2 mt-2" name="image" autocomplete="off" required>
                            <div class="content-image mt-3">
                                <img id="loadImg" src="">
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
