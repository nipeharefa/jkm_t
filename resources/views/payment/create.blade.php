@extends('layout.app')

@section('content')

    @include('errors.error')

    <div class="payment-form">
        <form action="{{ route('store.payment') }}" class="form" method="POST">
            <div class="form-group">
                <label for="">Order Number</label>
                <input type="text" class="form-control" name="order_number">
            </div>
            <div class="form-group">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection
