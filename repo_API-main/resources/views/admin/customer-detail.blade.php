@extends('layout.app')

@section('content')
<div class="m-3 d-flex">
    <a href="{{ route('admin.customer.index') }}" class="text-secondary"><i class="bi bi-arrow-left"></i></a>
    <div class="ms-2">
        <p class="my-2 fs-6 text-secondary">Back to customers</p>
        <h2 class="my-2 fw-bold title">{{ $customer->full_name }}</h2>
    </div>
</div>
<div class="row m-3">
    <div class="col-3 ps-0">
        @php
            $total = 0;

            foreach($customer->orders as $order) {
                $priceItem = 0;
                foreach($order->orderItems as $item) {
                    // Cộng tiền mỗi sản phẩm
                    $priceItem += ($item->variant->product->price * $item->quantity);
                }

                // Trừ tiền cho mỗi đơn hàng theo mã giảm giá
                if (isset($order->promo)) {
                    $priceItem -= ($order->promo->percentage/100 * $priceItem);
                }

                // Cộng tiền ship cho mỗi đơn hàng
                $priceItem += $order->shipping->price;

                $total += $priceItem;
            }
        @endphp

        <p class="m-0 mb-1 fw-bold">Total Cost</p>
        <p class="m-0 fs-2 fw-bold">${{ number_format($total) }}</p>
        <p class="m-0 fs-6 text-secondary">New cost last 365 days</p>
    </div>
    <div class="col-3 ps-0">
        <p class="m-0 mb-1 fw-bold">Total Order</p>
        <p class="m-0 fs-2 fw-bold d-flex align-items-center">{{$customer->orders->where('status', 0)->count()}}<span class="dot dot--progress"></span></p>
        <p class="m-0 fs-6 text-secondary">Total Order last 365 days</p>
    </div>
    <div class="col-3 ps-0">
        <p class="m-0 mb-1 fw-bold">Completed</p>
        <p class="m-0 fs-2 fw-bold d-flex align-items-center">{{$customer->orders->where('status', 1)->count()}}<span class="dot dot--completed"><span></p>
        <span class="m-0">Completed order last 365 days</span>
    </div>
    <div class="col-3 ps-0">
        <p class="m-0 mb-1 fw-bold">Canceled</p>
        <p class="m-0 fs-2 fw-bold d-flex align-items-center">{{$customer->orders->where('status', 2)->count()}}<span class="dot dot--canceled"></span></p>
        <p class="m-0 fs-6 text-secondary">Canceled order last 365 days</p>
    </div>
</div>

<div class="row m-3 mt-5">
    <div class="col-3 ps-0">
        <p class="fs-5 fw-bold">Customer Information</p>

        <div class="mt-2 ps-4">
            <p class="m-0 mb-1 fs-6 text-secondary">Name</p>
            <p class="m-0 mb-1 fs-6 fw-bold">{{ $customer->full_name }}</p>
            <p class="m-0 mb-1 fs-6 text-secondary">Nick name</p>
            <p class="m-0 mb-1 fs-6 fw-bold">{{ $customer->nick_name }}</p>
            <p class="m-0 mb-1 fs-6 text-secondary">Date of birth</p>
            <p class="m-0 mb-1 fs-6 fw-bold">{{ $customer->dob }}</p>
            <p class="m-0 mb-1 fs-6 text-secondary">Email</p>
            <p class="m-0 mb-1 fs-6 fw-bold">{{ $customer->email }}</p>
            <p class="m-0 mb-1 fs-6 text-secondary">Phone</p>
            <p class="m-0 mb-1 fs-6 fw-bold">{{ $customer->phone }}</p>
        </div>
    </div>
    <div class="col-9 ps-0">
        <p class="fs-5 fw-bold">Orders</p>
        <div class="d-flex">
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Items</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.customer.data-order', $customer->id) }}",
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
                        return `<span class="line-two">${row.order_items.reduce((arr, item) => { return [...arr, item.variant.product.name]; }, []).join(", ")}</span>`
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