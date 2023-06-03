@extends('layout.app')

@section('content')
    <h2 class="my-2 fw-bold title">Add Shipping</h2>
    <form action="{{ route('admin.shipping.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row py-2">
            <div class="col-12">
                <div class="my-3">
                    <label for="shipping_name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control mt-2" id="shipping_name" required >
                </div>
                <div class="my-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" max="999999" class="form-control mt-2" id="price" required step=".01">
                </div>
                <div class="my-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control mt-2" name="description" id="description" rows="4"></textarea>
                </div>
				<div class="d-flex justify-content-end my-3">
                    <a href="{{ route('admin.shipping.index') }}" type="button"
                        class="btn btn-outline-secondary w-25 me-2">Back</a>
                    <button type="submit" class="btn btn-success w-25">Add Shipping</button>
                </div>
            </div>
        </div>
    </form>
@endsection