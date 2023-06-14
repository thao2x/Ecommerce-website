@extends('layout.app')

@section('content')
    <h2 class="my-2 fw-bold title">Add Product</h2>
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row py-2">
            <div class="col-6">
                <div class="my-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control mt-2" id="product_name" required>
                </div>
                <div class="my-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select mt-2" name="category_id" id="category">
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="my-3">
                    <div class="row">
                        <div class="col-8">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" max="999999" class="form-control mt-2" id="price" step="0.01" required>
                        </div>
                        <div class="col-4">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select mt-2" name="type" id="type">
                                <option value="0">Draft</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="my-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control mt-2" name="description" id="description" rows="4"></textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="my-3">
                    <label for="product_name" class="form-label">Product Images</label>
                    <div class="d-flex justify-content-between">
                        <div class="pic-item pic-w40 change_img">
                            <i class="bi bi-card-image fs-4"></i>
                            <span>Drop your images here, or select <b>click to browser</b></span>
							<img class="d-none">
                            <input type="file" hidden name="image_a" id="image_add_a" class="drop-image"
                                accept="image/jpeg, image/png">
                        </div>
                        <div class="pic-item pic-w40 change_img">
                            <i class="bi bi-card-image fs-4"></i>
                            <span>Drop your images here, or select <b>click to browser</b></span>
							<img class="d-none">
                            <input type="file" hidden name="image_b" id="image_add_b" class="drop-image"
                                accept="image/jpeg, image/png">
                        </div>
                        <div class="pic-item between">
                            <div class="item-child change_img">
                                <i class="bi bi-card-image fs-4"></i>
                                <span>Drop your images here, or select <b>click to browser</b></span>
								<img class="d-none">
                                <input type="file" hidden name="image_c" id="image_add_c" class="drop-image"
                                    accept="image/jpeg, image/png">
                            </div>
                            <div class="item-child change_img">
                                <i class="bi bi-card-image fs-4"></i>
                                <span>Drop your images here, or select <b>click to browser</b></span>
								<img class="d-none">
                                <input type="file" hidden name="image_d" id="image_add_d" class="drop-image"
                                    accept="image/jpeg, image/png">
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-secondary">Your need to add at least 4 images. Pay attention tho the quantity of the pictures
                    your add, comply with the background color standards. Pictures must be in certain dimensions. Notice
                    that the product show all the details.</p>
                <div class="my-3">
                    <label for="size" class="form-label">Add size</label>
                    <input type="text" name="size" class="form-control mt-2" id="size">
                </div>
                <div class="d-flex justify-content-end my-3">
                    <a href="{{ route('admin.product.index') }}" type="button"
                        class="btn btn-outline-secondary w-25 me-2">Back</a>
                    <button type="submit" class="btn btn-success w-25">Add Product</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#size').tagify();

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
