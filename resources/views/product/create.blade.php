@extends('layout.app')

@section('content')
    @include('errors.error')

    <div class="form-container">
        <form class="form" method="POST" action="{{ route('create.order-product') }}">
            <div class="form-group">
                <label for="">Product</label>
                <textarea name="product" id="" rows="5" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="">Shipping Address</label>
                <textarea name="shipping_address" id="" rows="5" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="">Price</label>
                <input type="text" class="form-control" name="price" autocomplete="off">
            </div>

            <div class="form-group">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </form>
    </div>
@endsection
