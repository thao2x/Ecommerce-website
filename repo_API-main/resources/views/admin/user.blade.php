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
                        <label for="title">Name</label>
                        <input type="text" class="form-control py-2 mt-2" name="full_name"
                            value="{{ $user->full_name }}" autocomplete="off">
                        @error('full_name')
                        <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="title">Email</label>
                        <input type="text" class="form-control py-2 mt-2" name="email" value="{{ $user->email }}"
                            autocomplete="off">
                        @error('email')
                        <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="title">Date of Birth</label>
                        <input type="date" class="form-control py-2 mt-2" name="dob" value="{{ $user->dob }}"
                            autocomplete="off">
                    </div>
                    <div class="form-group mt-3">
                        <label for="description">Password</label>
                        <input type="password" class="form-control py-2 mt-2" name="password" value="password"
                            autocomplete="off">
                        @error('password')
                        <p class="text-danger pt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-6">
                <label for="product_name" class="form-label">Avatar</label>
                <div class="d-flex justify-content-between">
                    <div class="pic-item pic-w40 w-100 h-600 change_img">
                        <i class="bi bi-card-image fs-4 {{ $user->avatar ? 'd-none' : null }}"></i>
                        <span class="fs-6 {{ $user->avatar ? 'd-none' : null }}">Drop your images here, or
                            select <b>click to browser</b></span>
                        <img class="{{ $user->avatar ? null : 'd-none' }}"
                            src="{{ $user->avatar ? config('APP_URL') . '/storage' . $user->avatar : null }}">
                        <input type="file" hidden name="avatar" class="drop-image" accept="image/jpeg, image/png">
                    </div>
                </div>
            </div>
            {{-- Actions --}}
            <div class="d-flex  justify-content-end pt-3">
                <button type="submit" class="btn btn-success ms-2">Update</button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script>
    $(document).ready(function() {
            $(".drop-image").change(function() {
                readFile(this);
            });

            $(".change_img").click(function() {
                $(this).children('input')[0].click();
            });

            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var imagePreview = $(input).prev('img');
                        var i = $(input).siblings('i');
                        var span = $(input).siblings('span');
                        i.hide();
                        span.hide();
                        imagePreview.attr('src', e.target.result);
                        imagePreview.removeClass('d-none');
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        })
</script>
@endsection