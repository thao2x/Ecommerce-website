@extends('layout.app')

@section('content')
    <div class="d-flex justify-content-between my-3">
        <a class="btn btn-outline-primary w-auto" href="{{ route('admin.promo.create') }}">
            <span>Add Promo</span>
        </a>
    </div>
    <table class="table align-items-center mb-0" id="table">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">discount code</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">date pulished</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">percent</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">already used</th>
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
                ajax: "{{ route('admin.promo.data') }}",
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
                        width: '15%',
                    },
                    {
                        data: 'description',
                        width: '20%',
                    },
                    {
                        data: 'published_at',  
                        width: '15%',
                    },
                    {
                        data: 'percentage',
                        width: '10%',
                        render: function(data, type, row, meta) {
                            return `${data}%`
                        }
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
                            let url_detail = "{{ route('admin.promo.show', '--promoId--') }}";
                            let url_del = "{{ route('admin.promo.destroy', '--promoId--') }}";
                            return `<div>
                                <a class="btn btn-outline-success" href="${url_detail.replace("--promoId--", row.id)}"><i class="bi bi-pencil"></i></a>
                                <a class="btn btn-outline-danger" href="${url_del.replace("--promoId--", row.id)}"><i class="bi bi-trash"></i></a>
                            </div>`;
                        }
                    }
                ]
            });
        });
    </script>
@endsection
