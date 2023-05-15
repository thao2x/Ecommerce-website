@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Danh sách bộ sưu tập</h1>
    </div>
@endsection

@section('content')
    <div class="position-relative">
        {{-- Danh sách --}}
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <ul class="sidebar-nav pt-3 d-flex justify-content-between">
                    <li class="nav-item col-1">
                        <a class="nav-link justify-content-center">
                            <span>Tất cả</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link justify-content-center" onclick="add()">
                            <span>Thêm mới</span>
                        </a>
                    </li>
                </ul>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Thời gian</th>
                        </tr>
                    </thead>
                    <tbody id="tableData"></tbody>
                </table>
            </div>
        </div>

        {{-- Loading --}}
        <div id="loading_page" class="loading-page d-none"><span class="spinner-border me-2 text-primary" role="status"></span></div>

        {{-- Popup ADD --}}
        <div class="modal fade" id="popupAdd">
            <div class="modal-dialog">
                <div class="modal-content">
                    <h2 class="pt-3 pb-1 text-center">Thêm danh mục</h2>
                    <div class="modal-body">
                        <form id="addForm" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <label for="title">Tiêu đề</label>
                                <input type="text" class="form-control py-2 mt-2" id="name_add" name="name"
                                    autocomplete="off">
                                <p class="text-danger pt-2" id="name_error_add"></p>
                            </div>

                            <div class="form-group mt-3">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control py-2 mt-2" rows="3" id="description_add" name="description" autocomplete="off"></textarea>
                                <p class="text-danger pt-2" id="description_error_add"></p>
                            </div>

                            <div class="form-group mt-3">
                                <label for="image">Hình ảnh</label>
                                <div class="preview-zone hidden">
                                    <div class="box box-solid">
                                        <div class="box-body">
                                            <img width="200" class="image-preview" />
                                        </div>
                                    </div>
                                </div>
                                <div class="dropzone-wrapper mt-3">
                                    <div class="dropzone-desc">
                                        <i class="glyphicon glyphicon-download-alt"></i>
                                        <p>Chọn một tệp hình ảnh hoặc kéo nó vào đây.</p>
                                    </div>
                                    <input type="file" name="image" id="image_add" class="dropzone"
                                        accept="image/jpeg, image/png">
                                </div>
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
                    <h2 class="pt-3 pb-1 text-center">Chỉnh sửa danh mục</h2>
                    <div class="modal-body">
                        <form id="updateForm" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="id" id="id_update" />
                            <div class="form-group">
                                <label for="title">Tiêu đề</label>
                                <input type="text" class="form-control py-2 mt-2" id="name_update" name="name"
                                    autocomplete="off">
                                <p class="text-danger pt-2" id="name_error_update"></p>
                            </div>

                            <div class="form-group mt-3">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control py-2 mt-2" rows="3" id="description_update" name="description" autocomplete="off"></textarea>
                                <p class="text-danger pt-2" id="description_error_update"></p>
                            </div>

                            <div class="form-group mt-3">
                                <label for="image">Hình ảnh</label>
                                <div class="preview-zone">
                                    <div class="box box-solid">
                                        <div class="box-body">
                                            <img width="200" class="image-preview" />
                                        </div>
                                    </div>
                                </div>
                                <div class="dropzone-wrapper mt-3">
                                    <div class="dropzone-desc">
                                        <i class="glyphicon glyphicon-download-alt"></i>
                                        <p>Chọn một tệp hình ảnh hoặc kéo nó vào đây.</p>
                                    </div>
                                    <input type="file" name="image" id="image_update" class="dropzone"
                                        accept="image/jpeg, image/png">
                                </div>
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
    </div>

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
            const categories = @json($categories);
            const html = render(categories);
            const table = $('#tableData');
            table.html(html);
        }

        const render = (data) => {
            return data.map(function(item, index) {
                // Kiểm tra nếu category đã bị xóa chưa
                if (item.del_flg == 1) return;

                let productTotal = item?.products.length;
                let image = `http://127.0.0.1:9000/pojo/${item?.image}`;

                return `<tr>
                                <td scope="col" class="text-primary">
                                    <div class="position-relative">
                                        <img class="img-product" src="${image}" alt=""/>
                                        <a class="ps-3" onclick="edit('${item.id}')">${item.name}</a>
                                    </div>
                                </td>
                                <td scope="col">
                                    ${productTotal}
                                </td>
                                <td scope="col">
                                    ${item.created_at}
                                </td>
                                <td scope="col">
                                    <p class="text-center cursor-pointer" onclick="del('${item.id}')">
                                        <i class="bi bi-trash3-fill"></i>
                                    </p>
                                </td>
                            </tr>`
            });
        }

        const add = () => {
            $(".image-preview").attr('src', "");
            $('#popupAdd').modal('show');
        }

        const edit = (categoryId) => {
            let popup = $("#popupUpdate");
            let id = $("#id_update");
            let name = $("#name_update");
            let description = $("#description_update");
            let imagePreview = $(".image-preview");
            let loadingPage = $("#loading_page");

            // Hiển thị loading
            loadingPage.toggleClass("d-none");

            $.ajax({
                data: '',
                url: `/admin/category/${categoryId}`,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        id.val(response.data.id);
                        name.val(response.data.name);
                        description.val(response.data.description);
                        imagePreview.attr('src', `http://127.0.0.1:9000/pojo/${response.data.image}`);
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
            let table = $("#tableData");
            let form = $("#addForm");
            let popup = $("#popupAdd");
            let loading = $(".loading");
            loading.toggleClass("d-none");

            // Xóa error trước đó
            let errName = $("#name_error_add");
            let errDescription = $("#description_error_add");
            errName.text(null);
            errDescription.text(null);

            // Tạo form data
            var formData = new FormData();
            formData.append("_token", $('[name="_token"]').val());
            formData.append("image", $("#image_add")[0].files[0]);
            formData.append("name", $("#name_add").val());
            formData.append("description", $("#description_add").val());

            $.ajax({
                url: "{{ route('admin.category.store') }}",
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
                        form.trigger("reset");
                        popup.modal('hide');
                    } else {
                        // Hiển thị error validate
                        if (response.errors?.name?.length) {
                            errName.text(response.errors?.name[0]);
                        }

                        if (response.errors?.description?.length) {
                            errDescription.text(response.errors?.description[0]);
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
            let table = $("#tableData");
            let form = $("#updateForm");
            let popup = $("#popupUpdate");
            let loading = $(".loading");
            let _token = $('[name="_token"]').val();
            loading.toggleClass("d-none");

            // Xóa error trước đó
            let errName = $("#name_error_update");
            let errDescription = $("#description_error_update");
            errName.text(null);
            errDescription.text(null);

            // Tạo form data
            var formData = new FormData();
            formData.append("_token", _token);
            formData.append("image", $("#image_update")[0].files[0]);
            formData.append("name", $("#name_update").val());
            formData.append("description", $("#description_update").val());

            $.ajax({
                url: `/admin/category/${id}`,
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
                        form.trigger("reset");
                        popup.modal('hide');
                    } else {
                        // Hiển thị error validate
                        if (response.errors?.name?.length) {
                            errName.text(response.errors?.name[0]);
                        }

                        if (response.errors?.description?.length) {
                            errDescription.text(response.errors?.description[0]);
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

        const del = (categoryId) => {
            let table = $("#tableData");
            let loadingPage = $("#loading_page");
            let _token = $('[name="_token"]').val();

            // Hiển thị loading
            loadingPage.toggleClass("d-none");

            $.ajax({
                url: `/admin/category/${categoryId}`,
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
