@extends('layout.app')

@section('content')
    <h2 class="my-2 fw-bold title">Edit Promo</h2>
    <form action="{{ route('admin.promo.update', $promo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row py-2">
            <div class="col-12">
				<div class="my-3">
                    <label for="promo_name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control mt-2" id="promo_name" required value="{{ $promo->name }}">
                </div>
                <div class="my-3">
                    <label for="promo_name" class="form-label">Date Published</label>
                    <input type="date" name="published_at" class="form-control mt-2" id="promo_name" required value="{{ date_format($promo->published_at, 'Y-m-d') }}">
                </div>
                <div class="my-3">
                    <label for="price" class="form-label">Percentage</label>
                    <input type="number" name="percentage" max="999999" class="form-control mt-2" id="price" required
                        step=".01" value="{{ $promo->percentage }}">
                </div>
                <div class="my-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control mt-2" name="description" id="description" rows="4">{{ $promo->description }}</textarea>
                </div>
                <div class="d-flex justify-content-end my-3">
                    <a href="{{ route('admin.promo.index') }}" type="button"
                        class="btn btn-outline-secondary w-25 me-2">Back</a>
                    <button type="submit" class="btn btn-success w-25">Edit Promo</button>
                </div>
            </div>
        </div>
    </form>
@endsection
