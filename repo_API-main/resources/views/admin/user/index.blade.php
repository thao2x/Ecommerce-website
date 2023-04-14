@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Thông tin người dùng</h1>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('patch')
        <input type="hidden" name="id" value="{{$user->id}}">
        <div class="card py-4 px-3 rounded">
            <div class="row">
                <div class="col-6">
                    <div class="card-body p-0">
                        <div class="form-group">
                            <label for="title">Tên</label>
                            <input type="text" class="form-control py-2 mt-2" id="full_name" name="full_name" value="{{ $user->full_name }}" autocomplete="off" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="title">Email</label>
                            <input type="text" class="form-control py-2 mt-2" id="email" name="email" value="{{ $user->email }}" autocomplete="off" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="title">Ngày sinh</label>
                            <input type="date" class="form-control py-2 mt-2" id="dob" name="dob" value="{{ $user->dob }}" autocomplete="off">
                        </div>
                        <div class="form-group mt-3">
                            <label for="description">Password</label>
                            <input type="password" class="form-control py-2 mt-2" id="password" name="password" value="123456789" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="price">Ảnh đại diện</label>                            
                        <input type="text" id="avatar" class="form-control py-2 mt-2" name="avatar" value="{{ $user->avatar }}" autocomplete="off">
                        <div class="content-image mt-3">
                            <img id="loadImg" src="{{ $user->avatar }}" style="margin: 0 auto; display:block">
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
        $(document).ready(function () {
            $('#avatar').change(function() {
                let src = $(this).val();
                $('#loadImg').attr('src', src);
            });
        })
    </script>
@endsection
