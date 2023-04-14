@extends('layout.masterPage')
@section('title')
    <div class="pagetitle">
        <h1>Sản phẩm</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Thêm mới</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <style>
        .img-product {
            width: 42px;
            height: 42px;
            border-radius: 5px;
        }

		.bi {
			cursor: pointer;
		}
    </style>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{$product->id}}">
        <input type="hidden" name="user_id" value="{{$product->user_id}}">
        <div class="card recent-sales overflow-auto">
            <div class="card-body p-3">
                <div class="row pt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="name" value="{{$product->name}}" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="category">Danh mục sản phẩm</label>
                            <select class="form-control" id="category" name="category_id" value="{{$product->category_id}}" autocomplete="off" required>
                                @foreach ($categories as $item)                                
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="price">Giá</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{$product->price}}" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="type">Trạng thái sản phẩm</label>
                            <select class="form-control" id="type" name="type" value="{{$product->type}}" autocomplete="off" required>
                                <option value="1">Nháp</option>
                                <option value="2">Đang hoạt động</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" id="description" rows="3" name="description" autocomplete="off" required>{{$product->description}}</textarea>
                        </div>
                    </div>
                </div>
                <p class="pt-3 mb-0">Mẫu mã</p>
                <div class="row pt-3">
                    <div class="col-3">
                        <div class="border border-secondary rounded">
                            {{-- Variants head  --}}
                            <div class="row border-bottom p-3">
                                <div class="col-6">
                                    Kích thước
                                </div>
                                <div class="col-6 d-flex justify-content-center text-primary" id="showPopupNewVariant">
                                    <i class="bi bi-file-earmark-plus-fill"></i>
                                </div>
                            </div>
        
                            {{-- Variants body  --}}
                            <div id="variants"></div>
                        </div>
                    </div>
                    <div class="col-9"></div>
                </div>
    
                {{-- Actions --}}
                <div class="d-flex  justify-content-end">
                    <a href="{{ route('products.destroy', $product->id) }}" class="btn btn-outline-secondary me-2">Quay lại</a>
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                </div>
            </div>
        </div>    
    </form>

    {{-- Popup new variant --}}
    <div class="modal fade" id="newVariant" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm mẫu mã</h4>
                </div>
                <div class="modal-body">
                    <form id="postFormVariant" name="postForm" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}" />

                        <div class="form-group pt-2">
                            <label for="sizeVariant" class="control-label">Kích thước</label>
                            <input class="form-control pt-2" id="sizeVariant" name="size" required autocomplete="off"/>
                        </div>

                        <div class="pt-2 d-flex justify-content-end">
                            <button type="button" class="btn btn-success" id="btn-save-variant">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Popup edit variant --}}
    <div class="modal fade" id="editVariant" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chỉnh sửa mẫu mã</h4>
                </div>
                <div class="modal-body">
                    <form id="editFormVariant" name="editFormVariant" class="form-horizontal">
                        @csrf                        
                        <input type="hidden" name="id" id="idVariantEdit" />
                        <input type="hidden" name="product_id" value="{{$product->id}}" />

                        <div class="form-group pt-2">
                            <label for="sizeVariantEdit" class="control-label">Kích thước</label>
                            <input class="form-control pt-2" id="sizeVariantEdit" name="size" required autocomplete="off"/>
                        </div>

                        <div class="pt-2 d-flex justify-content-end">
                            <button type="button" class="btn btn-success" id="btn-edit-variant">Chỉnh sửa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    

    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Load danh sách variants ban đầu
            const firstVariants = @json($product->variants);
            loadVariantsData(firstVariants);

            // Hiển thị popup thêm Variant
            $('#showPopupNewVariant').click(function () {
                $('#newVariant').modal('show');
            });

            // Thêm variant
            $('#btn-save-variant').click(function () {
                $.ajax({
                    data: $("#postFormVariant").serialize(),
                    url: "{{ route('variants.store') }}",
                    type: "POST",
                    dataType: "json",
                    success: function (data) {
                        // Đóng popup
                        $("#postFormVariant").trigger("reset");
                        $('#newVariant').modal('hide');

                        // Load data
                        loadVariantsData(data);
                    },
                    error: function (data) {
                        console.log("Error:", data);
                        $('#newVariant').modal('hide');
                    },
                });
            });

            // Chỉnh sửa variant
            $('#btn-edit-variant').click(function () {
                let variantId =  $('#idVariantEdit').val();
                $.ajax({
                    data: $("#editFormVariant").serialize(),
                    url: `/admin/variants/${variantId}/update`,
                    type: "PATCH",
                    dataType: "json",
                    success: function (data) {
                        // Đóng popup
                        $("#editFormVariant").trigger("reset");
                        $('#editVariant').modal('hide');

                        // Load data
                        loadVariantsData(data);
                    },
                    error: function (data) {
                        console.log("Error:", data);
                        $('#editVariant').modal('hide');
                    },
                });
            });
        })

        // Hiển thị popup edit Variant
        function showPopupEdit(variantId) {
            $.ajax({
                url: '/admin/variants/'+variantId+'/show',
                type: "GET",
                success: function (data) {
                    $('#sizeVariantEdit').val(data?.size);
                    $('#idVariantEdit').val(data?.id);

                    $('#editVariant').modal('show');
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        }

        // Delete Variant
        function delVariant(variantId) {
            let productId = '{{ $product->id }}'
            $.ajax({
                url: `/admin/variants/${variantId}/destroy?product_id=${productId}`,
                type: "GET",
                success: function (data) {
                    
                    // Load data
                    loadVariantsData(data);
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        }

        // Load data variants
        function loadVariantsData(variants) {
            let elemant = $('#variants');
            let html = '';

            variants.forEach(function(item) {
                if (item.del_flg == 0) {
                    html += `<div class="row d-flex align-items-center p-3">
                                <div class="col-6 variant-size">
                                    ${item.size}
                                </div>
                                <div class="col-3 variant-edit d-flex justify-content-center" onclick="showPopupEdit('${item.id}')">
                                    <i class="bi bi-pencil-fill"></i>
                                </div>
                                <div class="col-3 variant-del d-flex justify-content-center" onclick="delVariant('${item.id}')">
                                    <i class="bi bi-trash3-fill"></i>
                                </div>
                            </div>`;
                }
            });

            elemant.html(html);
        }
    </script>
@endsection
