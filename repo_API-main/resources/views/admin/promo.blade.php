@extends('layout.app')
@section('title')
    <div class="pagetitle">
        <h1>Giảm giá</h1>
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
                            <th scope="col">Mô tả</th>
                            <th scope="col" class="text-center">Phần trăm</th>
                            <th scope="col" class="text-center">Đã sử dụng</th>
                            <th scope="col" class="text-center">Ngày phát hành</th>
                        </tr>
                    </thead>
                    <tbody id="tableData"></tbody>
                </table>
            </div>
        </div>

        {{-- Loading --}}
        <div id="loading_page" class="loading-page d-none"><span class="spinner-border me-2 text-primary"
                role="status"></span></div>

        {{-- Popup ADD --}}
        <div class="modal fade" id="popupAdd">
            <div class="modal-dialog">
                <div class="modal-content">
                    <h2 class="pt-3 pb-1 text-center">Thêm ưu đãi</h2>
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
                                <label for="percentage_add">Phần trăm</label>
                                <input type="number" class="form-control py-2 mt-2" id="percentage_add" name="percentage"
                                    autocomplete="off">
                                <p class="text-danger pt-2" id="percentage_error_add"></p>
                            </div>

                            <div class="form-group mt-3">
                                <label for="published_at_add">Ngày phát hành</label>
                                <input type="date" class="form-control py-2 mt-2" id="published_at_add"
                                    name="published_at" autocomplete="off">
                                <p class="text-danger pt-2" id="published_at_error_add"></p>
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
                    <h2 class="pt-3 pb-1 text-center">Chỉnh sửa giảm giá</h2>
                    <div class="modal-body">
                        <form id="updateForm" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="id" id="id_update" />
                            <div class="form-group">
                                <label for="name_update">Tiêu đề</label>
                                <input type="text" class="form-control py-2 mt-2" id="name_update" name="name"
                                    autocomplete="off">
                                <p class="text-danger pt-2" id="name_error_update"></p>
                            </div>

                            <div class="form-group mt-3">
                                <label for="description_update">Mô tả</label>
                                <textarea class="form-control py-2 mt-2" rows="3" id="description_update" name="description" autocomplete="off"></textarea>
                                <p class="text-danger pt-2" id="description_error_update"></p>
                            </div>

                            <div class="form-group mt-3">
                                <label for="percentage_update">Phần trăm</label>
                                <input type="number" class="form-control py-2 mt-2" id="percentage_update"
                                    name="percentage" autocomplete="off">
                                <p class="text-danger pt-2" id="percentage_error_update"></p>
                            </div>

                            <div class="form-group mt-3">
                                <label for="published_at_update">Ngày phát hành</label>
                                <input type="date" class="form-control py-2 mt-2" id="published_at_update"
                                    name="published_at" autocomplete="off">
                                <p class="text-danger pt-2" id="published_at_error_update"></p>
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
            const promos = @json($promos);
            const html = render(promos);
            const table = $('#tableData');
            table.html(html);
        }

        const render = (data) => {
            return data.map(function(item, index) {
                // Kiểm tra đã bị xóa chưa
                if (item.del_flg == 1) return;

                return `<tr>
                                <td scope="col" class="text-primary">
                                    <div class="position-relative">
                                        <a class="ps-3" onclick="edit('${item.id}')">${item.name}</a>
                                    </div>
                                </td>
                                <td scope="col">
                                    ${item.description}
                                </td>
                                <td scope="col" class="text-center">
                                    ${item.percentage}%
                                </td>
                                <td scope="col" class="text-center">
                                    ${item.orders?.length | 0}
                                </td>
                                <td scope="col" class="text-center">
                                    ${item.published_at}
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
            $('#popupAdd').modal('show');
        }

        const edit = (promoId) => {
            let popup = $("#popupUpdate");
            let id = $("#id_update");
            let name = $("#name_update");
            let description = $("#description_update");
            let percentage = $("#percentage_update");
            let publishedAt = $("#published_at_update");
            let loadingPage = $("#loading_page");

            // Hiển thị loading
            loadingPage.toggleClass("d-none");

            $.ajax({
                url: `/admin/promo/${promoId}`,
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        id.val(response.data.id);
                        name.val(response.data.name);
                        description.val(response.data.description);
                        percentage.val(response.data.percentage);
                        publishedAt.val(response.data.published_at);
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
            $("#name_error_add").text("");
            $("#description_error_add").text("");
            $("#percentage_error_add").text("");
            $("#published_at_error_add").text("");

            // Tạo form data
            var formData = new FormData();
            formData.append("_token", $('[name="_token"]').val());
            formData.append("name", $("#name_add").val());
            formData.append("description", $("#description_add").val());
            formData.append("percentage", $("#percentage_add").val());
            formData.append("published_at", $("#published_at_add").val());

            $.ajax({
                url: "{{ route('admin.promo.store') }}",
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
                            $("#name_error_add").text(response.errors?.name[0]);
                        }
                        if (response.errors?.description?.length) {
                            $("#description_error_add").text(response.errors?.description[0]);
                        }
                        if (response.errors?.percentage?.length) {
                            $("#percentage_error_add").text(response.errors?.percentage[0]);
                        }
                        if (response.errors?.published_at?.length) {
                            $("#published_at_error_add").text(response.errors?.published_at[0]);
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
            let promoId = $("#id_update").val();
            let table = $("#tableData");
            let form = $("#updateForm");
            let popup = $("#popupUpdate");
            let loading = $(".loading");
            loading.toggleClass("d-none");

            // Xóa error trước đó
            $("#name_error_update").text("");
            $("#description_error_update").text("");
            $("#percentage_error_update").text("");
            $("#published_at_error_update").text("");

            // Tạo form data
            var formData = new FormData();
            formData.append("_token", $('[name="_token"]').val());
            formData.append("name", $("#name_update").val());
            formData.append("description", $("#description_update").val());
            formData.append("percentage", $("#percentage_update").val());
            formData.append("published_at", $("#published_at_update").val());

            $.ajax({
                url: `/admin/promo/${promoId}`,
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
                            $("#name_error_update").text(response.errors?.name[0]);
                        }
                        if (response.errors?.description?.length) {
                            $("#description_error_update").text(response.errors?.description[0]);
                        }
                        if (response.errors?.percentage?.length) {
                            $("#percentage_error_update").text(response.errors?.percentage[0]);
                        }
                        if (response.errors?.published_at?.length) {
                            $("#published_at_error_update").text(response.errors?.published_at[0]);
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

        const del = (promoId) => {
            let table = $("#tableData");
            let loadingPage = $("#loading_page");
            let _token = $('[name="_token"]').val();

            // Hiển thị loading
            loadingPage.toggleClass("d-none");

            $.ajax({
                url: `/admin/promo/${promoId}`,
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
