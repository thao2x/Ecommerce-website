@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Sản phẩm</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <style>
        .dropzone-wrapper {
            min-height: 150px;
            height: auto;
        }

        .dropzone-desc {
            position: unset;
            width: 100%;
        }
    </style>
    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" class="position-relative">
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
        <input type="hidden" name="user_id" value="{{ $product->user_id }}">
        <div class="card recent-sales">
            <div class="card-body p-3">
                <div class="row pt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tiêu đề</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $product->name }}" autocomplete="off">
                            @error('name')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="category">Danh mục sản phẩm</label>
                            <select class="form-control" id="category" name="category_id"
                                value="{{ $product->category_id }}" autocomplete="off">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $product->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="price">Giá</label>
                            <input type="text" class="form-control" id="price" name="price"
                                value="{{ $product->price }}" autocomplete="off">
                            @error('price')
                                <p class="text-danger pt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="type">Trạng thái sản phẩm</label>
                            <select class="form-control" id="type" name="type" value="{{ $product->type }}"
                                autocomplete="off">
                                <option value="1" {{ $product->type == 1 ? 'selected' : '' }}>Nháp</option>
                                <option value="2" {{ $product->type == 2 ? 'selected' : '' }}>Đang hoạt động</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" id="description" rows="3" name="description" autocomplete="off">{{ $product->description }}</textarea>
                        </div>
                    </div>
                </div>
                <p class="pt-3 mb-0">Mẫu mã</p>
                <div class="row pt-3">
                    <div class="col-8">
                        <div class="border border-secondary rounded">
                            {{-- Variants head  --}}
                            <div class="row p-3">
                                <div class="col-6">
                                    Kích thước
                                </div>
                                <div class="col-6 d-flex justify-content-center text-primary cursor-pointer"
                                    onclick="add()">
                                    <i class="bi bi-file-earmark-plus-fill"></i>
                                </div>
                            </div>

                            {{-- Variants body  --}}
                            <div id="variants_data"></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="dropzone-wrapper">
                            <div class="dropzone-desc">
                                <div class="preview-zone hidden">
                                    <div class="box box-solid">
                                        <div class="box-body">
                                            <img width="200" class="image-preview" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="file" name="image" id="image_add" class="dropzone"
                                accept="image/jpeg, image/png">
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="d-flex  justify-content-between mt-3">
                    <a href="{{ route('admin.product.index') }}" class="btn btn-outline-primary me-2">Quay lại</a>
                    <div>
                        <a href="{{ route('admin.product.destroy', $product->id) }}"
                            class="btn btn-outline-danger me-2">Xóa sản phẩm</a>
                        <button type="submit" class="btn btn-success">Chỉnh sửa</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Loading --}}
        <div id="loading_page" class="loading-page d-none"><span class="spinner-border me-2 text-primary"
                role="status"></span></div>

        {{-- Popup ADD --}}
        <div class="modal fade" id="popupAdd">
            <div class="modal-dialog">
                <div class="modal-content">
                    <h2 class="pt-3 pb-1 text-center">Thêm mẫu mã</h2>
                    <div class="modal-body">
                        <form id="addForm" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <label for="size">Kích thước</label>
                                <input type="text" class="form-control py-2 mt-2" id="size_add" name="size"
                                    autocomplete="off">
                                <p class="text-danger pt-2" id="size_error_add"></p>
                            </div>

                            <div class="pt-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-success" onclick="store()">
                                    <span class="spinner-border spinner-border-sm me-2 d-none loading"
                                        role="status"></span>Thêm mới
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Popup UPDATE --}}
        <div class="modal fade" id="popupUpdate">
            <div class="modal-dialog">
                <div class="modal-content">
                    <h2 class="pt-3 pb-1 text-center">Chỉnh sửa mẫu mã</h2>
                    <div class="modal-body">
                        <form id="updateForm" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="id" id="id_update" />

                            <div class="form-group">
                                <label for="size_update">Kích thước</label>
                                <input type="text" class="form-control py-2 mt-2" id="size_update" name="size"
                                    autocomplete="off">
                                <p class="text-danger pt-2" id="size_error_update"></p>
                            </div>

                            <div class="pt-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-success" onclick="update()">
                                    <span class="spinner-border spinner-border-sm me-2 d-none loading"
                                        role="status"></span>Chỉnh sửa
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            init();
        })

        const init = () => {
            const variants = @json($variants);
            const html = render(variants);
            const table = $('#variants_data');
            table.html(html);
        }

        const render = (data) => {
            return data.map(function(item, index) {
                // Kiểm tra đã xóa chưa
                if (item.del_flg == 1) return;

                return `<div class="row d-flex align-items-center p-3">
                                <div class="col-6 variant-size">
                                    ${item.size}
                                </div>
                                <div class="col-3 variant-edit d-flex justify-content-center cursor-pointer" onclick="edit('${item.id}')">
                                    <i class="bi bi-pencil-fill"></i>
                                </div>
                                <div class="col-3 variant-del d-flex justify-content-center cursor-pointer" onclick="del('${item.id}')">
                                    <i class="bi bi-trash3-fill"></i>
                                </div>
                            </div>`
            });
        }

        const add = () => {
            $('#popupAdd').modal('show');
        }

        const edit = (variantId) => {
            let popup = $("#popupUpdate");
            let id = $("#id_update");
            let size = $("#size_update");
            let loadingPage = $("#loading_page");

            // Hiển thị loading
            loadingPage.toggleClass("d-none");

            $.ajax({
                url: `/admin/variant/${variantId}`,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        id.val(response.data.id);
                        size.val(response.data.size);
                    }
                },
                error: function(response) {
                    alert(response.responseJSON.message);
                },
                complete: function(response) {
                    popup.modal('show');
                    loadingPage.toggleClass("d-none");
                }
            });
        }

        const store = () => {
            let table = $("#variants_data");
            let form = $("#addForm");
            let popup = $("#popupAdd");
            let loading = $(".loading");
            loading.toggleClass("d-none");

            // Xóa error trước đó
            $("#size_error_add").text("");

            // Tạo form data
            var formData = new FormData();
            formData.append("_token", $('[name="_token"]').val());
            formData.append("size", $("#size_add").val());
            formData.append("product_id", "{{ $product->id }}");

            $.ajax({
                url: "{{ route('admin.variant.store') }}",
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        // Tải lại dữ liệu table
                        const html = render(response.data);
                        table.html(html);

                        // Đóng popup
                        popup.modal('hide');

                        // Reset                        
                        $("#size_add").val("");
                    } else {
                        // Hiển thị error validate
                        if (response.errors?.size?.length) {
                            $("#size_error_add").text(response.errors?.size[0]);
                        }
                    }
                },
                error: function(response) {
                    alert(response.responseJSON.message);
                },
                complete: function(response) {
                    loading.toggleClass("d-none");
                }
            });
        }

        const update = () => {
            let id = $("#id_update").val();
            let table = $("#variants_data");
            let form = $("#updateForm");
            let popup = $("#popupUpdate");
            let loading = $(".loading");
            let _token = $('[name="_token"]').val();
            loading.toggleClass("d-none");

            // Xóa error trước đó
            $("#size_error_update").text("");

            // Tạo form data
            var formData = new FormData();
            formData.append("_token", _token);
            formData.append("size", $("#size_update").val());
            formData.append("product_id", "{{ $product->id }}");

            $.ajax({
                url: `/admin/variant/${id}`,
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        // Tải lại dữ liệu table
                        const html = render(response.data);
                        table.html(html);

                        // Đóng popup
                        popup.modal('hide');

                        // Reset                        
                        $("#size_update").val("");
                    } else {
                        // Hiển thị error validate
                        if (response.errors?.size?.length) {
                            $("#size_error_update").text(response.errors?.size[0]);
                        }
                    }
                },
                error: function(response) {
                    alert(response.responseJSON.message);
                },
                complete: function(response) {
                    loading.toggleClass("d-none");
                }
            });
        }

        const del = (variantId) => {
            let table = $("#variants_data");
            let loadingPage = $("#loading_page");
            let _token = $('[name="_token"]').val();

            // Hiển thị loading
            loadingPage.toggleClass("d-none");

            var formData = new FormData();
            formData.append("_token", _token);
            formData.append("product_id", "{{ $product->id }}");

            $.ajax({
                url: `/admin/variant/${variantId}`,
                type: "DELETE",
                data: {
                    "_token": _token,
                },
                success: function(response) {
                    if (response.success) {
                        // Tải lại dữ liệu table
                        const html = render(response.data);
                        table.html(html);
                    }
                },
                error: function(response) {
                    alert(response.responseJSON.message);
                },
                complete: function(response) {
                    loadingPage.toggleClass("d-none");
                }
            });
        }
    </script>
@endsection
