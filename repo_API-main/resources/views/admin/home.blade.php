@extends('layout.app')
@section('title')
    <div class="pagetitle">
        <h1>Thống kê danh thu</h1>
    </div>
@endsection

@section('content')
    <!-- Recent Sales -->
	<p class="fs-3">Đơn hàng</p>
    <div class="row">
		<div class="col-3">
			<div class="card recent-sales overflow-auto bg-warning mb-0">
				<div class="card-body p-0 d-flex justify-content-around">
					<div class="d-flex align-items-start justify-content-around flex-column">
						<p class="p-0 m-0 fs-1 text-light">{{ $total }}</p>
						<p class="p-0 m-0 fs-6 mb-3 text-light">Tổng đơn hàng</p>
					</div>
					<i class="bi bi-bar-chart-fill text-black-50" style="font-size: 100px"></i>
				</div>
			</div>                
		</div>
		<div class="col-3">
			<div class="card recent-sales overflow-auto bg-info mb-0">
				<div class="card-body p-0 d-flex justify-content-around">
					<div class="d-flex align-items-start justify-content-around flex-column">
						<p class="p-0 m-0 fs-1 text-light">{{ $total_no_process }}</p>
						<p class="p-0 m-0 fs-6 mb-3 text-light">Đơn hàng chưa xử lý</p>
					</div>
					<i class="bi bi-bar-chart-line text-black-50" style="font-size: 100px"></i>
				</div>
			</div>
		</div>
		<div class="col-3">
			<div class="card recent-sales overflow-auto bg-success mb-0">
				<div class="card-body p-0 d-flex justify-content-around">
					<div class="d-flex align-items-start justify-content-around flex-column">
						<p class="p-0 m-0 fs-1 text-light">{{ $total_processed }}</p>
						<p class="p-0 m-0 fs-6 mb-3 text-light">Đơn hàng đã xử lý</p>
					</div>
					<i class="bi bi-bar-chart-fill text-black-50" style="font-size: 100px"></i>
				</div>
			</div>
		</div>
		<div class="col-3">
			<div class="card recent-sales overflow-auto bg-danger mb-0">
				<div class="card-body p-0 d-flex justify-content-around">
					<div class="d-flex align-items-start justify-content-around flex-column">
						<p class="p-0 m-0 fs-1 text-light">{{ $total_cancelled }}</p>
						<p class="p-0 m-0 fs-6 mb-3 text-light">Đơn hàng đã hủy</p>
					</div>
					<i class="bi bi-bar-chart-steps text-black-50" style="font-size: 100px"></i>
				</div>
			</div>
		</div>
	</div>

	<p class="fs-3 mt-3">Doanh thu</p>
    <div class="row">
		<div class="col-3">
			<div class="card recent-sales overflow-auto bg-success mb-0">
				<div class="card-body p-0 d-flex justify-content-around">
					<div class="d-flex align-items-start justify-content-around flex-column">
						<p class="p-0 m-0 fs-4 text-light">9,000,000 vnđ</p>
						<p class="p-0 m-0 fs-6 mb-3 text-light">Toàn bộ</p>
					</div>
					<i class="bi bi-cash-coin text-black-50" style="font-size: 70px"></i>
				</div>
			</div>                
		</div>
		<div class="col-3">
			<div class="card recent-sales overflow-auto bg-info mb-0">
				<div class="card-body p-0 d-flex justify-content-around">
					<div class="d-flex align-items-start justify-content-around flex-column">
						<p class="p-0 m-0 fs-4 text-light">2,000,000 vnđ</p>
						<p class="p-0 m-0 fs-6 mb-3 text-light">Tháng này</p>
					</div>
					<i class="bi bi-cart4 text-black-50" style="font-size: 70px"></i>
				</div>
			</div>
		</div>
		<div class="col-3">
			<div class="card recent-sales overflow-auto bg-warning mb-0">
				<div class="card-body p-0 d-flex justify-content-around">
					<div class="d-flex align-items-start justify-content-around flex-column">
						<p class="p-0 m-0 fs-4 text-light">1,000,000 vnđ</p>
						<p class="p-0 m-0 fs-6 mb-3 text-light">Tuần này</p>
					</div>
					<i class="bi bi-cart-check-fill text-black-50" style="font-size: 70px"></i>
				</div>
			</div>
		</div>
		<div class="col-3">
			<div class="card recent-sales overflow-auto bg-secondary mb-0">
				<div class="card-body p-0 d-flex justify-content-around">
					<div class="d-flex align-items-start justify-content-around flex-column">
						<p class="p-0 m-0 fs-4 text-light">0 vnđ</p>
						<p class="p-0 m-0 fs-6 mb-3 text-light">Đơn hàng đã hủy</p>
					</div>
					<i class="bi bi-cart-x-fill text-black-50" style="font-size: 70px"></i>
				</div>
			</div>
		</div>
	</div>
@endsection
