@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between my-3 mb-1">
    <h2 class="my-2 fw-bold title">Order List</h2>
</div>
<div class="d-flex mt-2">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" value="" id="all" checked>
        <label class="form-check-label text-uppercase" for="all">
            All Orders
        </label>
    </div>
    <div class="form-check ms-2">
        <input class="form-check-input" type="radio" name="status" value="0" id="processing">
        <label class="form-check-label text-uppercase" for="processing">
            Processing
        </label>
    </div>
    <div class="form-check ms-2">
        <input class="form-check-input" type="radio" name="status" value="1" id="completed">
        <label class="form-check-label text-uppercase" for="completed">
            Completed
        </label>
    </div>
    <div class="form-check ms-2">
        <input class="form-check-input" type="radio" name="status" value="2" id="canceled">
        <label class="form-check-label text-uppercase" for="canceled">
            Canceled
        </label>
    </div>
</div>
<table class="table align-items-center mb-0" id="table">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order ID</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order Date</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Items</th>
        </tr>
    </thead>
</table>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.order.data') }}",
            autoWidth: false,
            language: {
                paginate: {
                    first:      "<<",
                    last:       ">>",
                    next:       ">",
                    previous:   "<"
                },
            },
            columns: [
                { 
                    data: 'code',
                    width: '20%',
                    render: function(data, type, row, meta){
                        let url_detail = "{{ route('admin.order.show', '--code--') }}";
                        return `<a href="${url_detail.replace("--code--", row.id)}">#${row.code}</a>`;
                    }
                },
                { 
                    data: 'created_at',
                    width: '15%',
                },
                { 
                    data: 'customer',
                    width: '25%',
                    render: function(data, type, row, meta){
                        return data.full_name;
                    }
                },
                { 
                    data: 'order_items',
                    width: '15%',
                    render: function(data, type, row, meta){
                        let total = 0;
                        let amount = row.order_items.reduce((total, item) => total + (item.variant.product.price * item.quantity), 0);
                        total += amount;
                        total += row.shipping.price;
                        if (row.promo) {
                            total -= row.promo.percentage / 100 * amount;
                        }
                        return `$${total.toLocaleString("en-IN")}`;
                    }
                },
                { 
                    data: 'status',
                    width: '15%',
                    render: function(data, type, row, meta){
                        if (parseInt(data) == 0) {
                            return `<span class="badge badge-sm bg-gradient-secondary w-auto">Processing</span>`;
                        }
                        if (parseInt(data) == 1) {
                            return `<span class="badge badge-sm bg-gradient-success w-auto">Completed</span>`;
                        }
                        return `<span class="badge badge-sm bg-gradient-cancel w-auto">Canceled</span>`;
                    }
                },
                { 
                    data: 'order_items',
                    width: '10%',
                    render: function(data, type, row, meta){
                        return `${data.length} items`;
                    }
                }
            ]
        });

        $('[name="status"]').on('change', function(){
            let status = $(this).val() ? "^" + $(this).val() + "$" : "";
            table.column(4).search(status, true, false, true).draw();
        });

        $('#table_length').hide();
        $('#table_filter').hide();
        $('#table_info').hide();
    });
</script>
@endsection