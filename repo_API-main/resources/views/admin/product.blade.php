@extends('layout.app')

@section('content')
    <div class="d-flex justify-content-between my-3">
        <a class="btn btn-outline-primary w-auto" href="{{ route('admin.product.create') }}">
            <span>Add Product</span>
        </a>
    </div>
    <table class="table align-items-center mb-0" id="table">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Brand</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
            </tr>
        </thead>
    </table>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.product.data') }}",
                autoWidth: false,
                language: {
                    paginate: {
                        first: "<<",
                        last: ">>",
                        next: ">",
                        previous: "<"
                    },
                },
                columns: [{
                        data: 'name',
                        width: '30%',
                        render: function(data, type, row, meta) {
                            let url_detail = "{{ route('admin.product.show', '--productID--') }}";
                            return `<div class="d-flex px-2 py-1">
                                    <div>
                                        <img class="avatar avatar-sm me-3" src="${row.images.length ? "{{ config('APP_URL') . '/storage' }}" + row.images[0]?.src : " {{ asset('assets/img/no_image.png') }}"}">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <a class="ps-3" href="${url_detail.replace("--productID--", row.id)}">${row.name}</a>
                                    </div>
                                </div>`;
                        }
                    },
                    {
                        data: 'category',
                        width: '15%',
                        render: function(data, type, row, meta) {
                            return data.name;
                        }
                    },
                    {
                        data: 'type',
                        width: '15%',
                        render: function(data, type, row, meta) {
                            if (parseInt(data) == 0) {
                                return `<span class="badge badge-sm bg-gradient-secondary">Draft</span>`;
                            }
                            return `<span class="badge badge-sm bg-gradient-success">Active</span>`;
                        }
                    },
                    {
                        data: 'price',
                        width: '10%',
                        render: function(data, type, row, meta) {
                            return `<i class="bi bi-currency-dollar"></i>${data.toLocaleString("en-IN")}`;
                        }
                    },
                    {
                        data: 'description',
                        width: '20%',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return `<span class="line-two">${data}</span>`
                            };
                            return '';
                        }
                    },
                    {
                        data: 'id',
                        width: '10%',
                        render: function(data, type, row, meta) {
                            let url_detail = "{{ route('admin.product.show', '--productID--') }}";
                            let url_del = "{{ route('admin.product.destroy', '--productID--') }}";
                            return `<div>
                                <a class="btn btn-outline-success" href="${url_detail.replace("--productID--", row.id)}"><i class="bi bi-pencil"></i></a>
                                <a class="btn btn-outline-danger" href="${url_del.replace("--productID--", row.id)}"><i class="bi bi-trash"></i></a>
                            </div>`;
                        }
                    }
                ]
            });
        });
    </script>
@endsection
