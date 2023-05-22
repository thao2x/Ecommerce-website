@extends('layout.app')
@section('title')
    <div class="pagetitle">
        <h1>Thông tin người dùng</h1>
    </div>
@endsection

@section('content')
    <form action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="card py-4 px-3 rounded">
            <div class="row">
                <div class="col-6">
                    <div class="card-body p-0">
                        <div class="form-group">
                            <label for="title">Tên</label>
                            <input type="text" class="form-control py-2 mt-2" id="full_name" name="full_name"
                                value="{{ $user->full_name }}" autocomplete="off">
                            @error('full_name')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="title">Email</label>
                            <input type="text" class="form-control py-2 mt-2" id="email" name="email"
                                value="{{ $user->email }}" autocomplete="off">
                            @error('email')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="title">Ngày sinh</label>
                            <input type="date" class="form-control py-2 mt-2" id="dob" name="dob"
                                value="{{ $user->dob }}" autocomplete="off">
                        </div>
                        <div class="form-group mt-3">
                            <label for="description">Password</label>
                            <input type="password" class="form-control py-2 mt-2" id="password" name="password"
                                value="123456789" autocomplete="off">
                            @error('password')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="image">Hình ảnh</label>
                        <div class="preview-zone">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <img width="200" class="image-preview rounded" />
                                </div>
                            </div>
                        </div>
                        <div class="dropzone-wrapper mt-3 rounded">
                            <div class="dropzone-desc">
                                <i class="glyphicon glyphicon-download-alt"></i>
                                <p>Chọn một tệp hình ảnh hoặc kéo nó vào đây.</p>
                            </div>
                            <input type="file" name="avatar" id="image_add" class="dropzone"
                                accept="image/jpeg, image/png">
                        </div>
                    </div>
                </div>
                {{-- Actions --}}
                <div class="d-flex  justify-content-end pt-3">
                    <button type="submit" class="btn btn-success ms-2">Chỉnh sửa</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        // Cho nay de lai a tim cach fix sau nha
        $(document).ready(function() {
            //$(".image-preview").attr('src', String.fromCodePoint(parseInt("{{ config('APP_URL') . 'storage' . $user->avatar}}", 16)));
        })
    </script>
@endsection
