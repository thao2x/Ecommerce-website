@extends('layout.app')

@section('content')
    <h2 class="my-2 fw-bold title">Add Category</h2>
    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row py-2">
            <div class="col-8">
                <div class="my-3">
                    <label for="product_name" class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control mt-2" id="product_name" required>
                </div>
                <div class="my-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control mt-2" name="description" id="description" rows="4"></textarea>
                </div>
            </div>
            <div class="col-4">
                <div class="my-3">
                    <label for="product_name" class="form-label">Category Image</label>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="pic-item pic-w40 w-100 change_img">
                            <i class="bi bi-card-image fs-4"></i>
                            <span class="fs-6">Drop your images here, or select <b>click to browser</b></span>
							<img class="d-none">
                            <input type="file" hidden name="image" class="drop-image"
                                accept="image/jpeg, image/png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end my-3">
            <a href="{{ route('admin.category.index') }}" type="button"
                class="btn btn-outline-secondary w-auto me-2">Back</a>
            <button type="submit" class="btn btn-success w-auto">Add Category</button>
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
