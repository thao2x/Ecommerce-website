@extends('layout.app')

@section('content')
    <div class="d-flex justify-content-between my-3 mb-1">
        <h2 class="my-2 fw-bold title">Customer List</h2>
    </div>
    <table class="table align-items-center mb-0" id="table">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="2">Customer name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">phone</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">email</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">oders</th>
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
                ajax: "{{ route('admin.customer.data') }}",
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
                        data: 'avatar',
                        width: '2%',
                        render: function(data, type, row, meta) {
                            let url_detail = "{{ route('admin.customer.show', '--customerId--') }}";
                            return `<div>
                                        <img class="avatar avatar-sm me-3" src="${data ? "{{ config('APP_URL') . '/storage' }}" + data : " {{ asset('assets/img/no_image.png') }}"}">
                                    </div>`;
                        }
                    },
                    {
                        data: 'name',
                        width: '23%',
                        render: function(data, type, row, meta) {
                            let url_detail = "{{ route('admin.customer.show', '--customerId--') }}";
                            return `<div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <a class="" href="${url_detail.replace("--customerId--", row.id)}">${row.full_name}</a>
                                    </div>
                                </div>`;
                        }
                    },
                    {
                        data: 'phone',
                        width: '20%',
                    },
                    {
                        data: 'email',
                        width: '25%',
                    },
                    {
                        data: 'orders',
                        width: '10%',
                        render: function(data, type, row, meta) {
                            return data.length;
                        }
                    },
                    {
                        data: 'id',
                        width: '10%',
                        render: function(data, type, row, meta) {
                            let url_del = "{{ route('admin.customer.destroy', '--customerId--') }}";
                            return `<div>
                            <a class="btn btn-outline-danger" href="${url_del.replace("--customerId--", row.id)}"><i class="bi bi-trash"></i></a>
                        </div>`;
                        }
                    }
                ]
            });
        });
    </script>
@endsection
