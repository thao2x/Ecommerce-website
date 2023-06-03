@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between my-3">
    <a class="btn btn-outline-primary w-auto" href="{{ route('admin.category.create') }}">
        <span>Add Categogy</span>
    </a>
</div>
<table class="table align-items-center mb-0" id="table">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">logo</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Branch name</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">products</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Create at</th>
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
                ajax: "{{ route('admin.category.data') }}",
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
                        data: 'image',
                        width: '15%',
                        render: function(data, type, row, meta) {
                            return `<img class="avatar avatar-sm me-3" src="${row.image ? "{{ config('APP_URL') . '/storage' }}" + row.image : " {{ asset('assets/img/no_image.png') }}"}">`
                        }
                    },
                    {
                        data: 'name',
                        width: '20%',
                    },
                    {
                        data: 'products',
                        width: '20%',
                        render: function(data, type, row, meta) {
                            return data.length;
                        }
                    },
                    {
                        data: 'created_at',
                        width: '20%',
                    },
                    {
                        data: 'id',
                        width: '15%',
                        render: function(data, type, row, meta) {
                            let url_detail = "{{ route('admin.category.show', '--categoryId--') }}";
                            let url_del = "{{ route('admin.category.destroy', '--categoryId--') }}";
                            return `<div>
                                <a class="btn btn-outline-success" href="${url_detail.replace("--categoryId--", row.id)}"><i class="bi bi-pencil"></i></a>
                                <a class="btn btn-outline-danger" href="${url_del.replace("--categoryId--", row.id)}"><i class="bi bi-trash"></i></a>
                            </div>`;
                        }
                    }
                ]
            });
        });
</script>
@endsection