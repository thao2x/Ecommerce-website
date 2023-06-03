@extends('layout.app')

@section('content')
    <div class="d-flex justify-content-between my-3">
        <a class="btn btn-outline-primary w-auto" href="{{ route('admin.shipping.create') }}">
            <span>Add Shipping</span>
        </a>
    </div>
    <table class="table align-items-center mb-0" id="table">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">price</th>
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
                ajax: "{{ route('admin.shipping.data') }}",
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
                        width: '20%',
                    },
                    {
                        data: 'description',
                        width: '20%',
                    },
                    {
                        data: 'price',
                        width: '10%',
                        render: function(data, type, row, meta) {
                            return `$${data}`;
                        }
                    },
                    {
                        data: 'id',
                        width: '10%',
                        render: function(data, type, row, meta) {
                            let url_detail = "{{ route('admin.shipping.show', '--shippingId--') }}";
                            let url_del = "{{ route('admin.shipping.destroy', '--shippingId--') }}";
                            return `<div>
                                <a class="btn btn-outline-success" href="${url_detail.replace("--shippingId--", row.id)}"><i class="bi bi-pencil"></i></a>
                                <a class="btn btn-outline-danger" href="${url_del.replace("--shippingId--", row.id)}"><i class="bi bi-trash"></i></a>
                            </div>`;
                        }
                    }
                ]
            });
        });
    </script>
@endsection
