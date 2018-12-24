@extends('layout.app')

@section('content')
    <div class="success-order">
        <p class="text-center">Your Order Number</p>
        <p class="text-center">{{ $orderNumber }}</p>
        <p class="text-center">Total</p>
        <p class="text-center">{{ $total }}</p>

        <div class="clearfix">
            <p class="text-center">{{ $productName }} that cost {{ $price }} will be shipped to {{ $shippingAddress }} </p>
            <p class="text-center">after you pay</p>
        </div>

        <div class="clearfix text-center">
            <a href="{{ route('create.payment') }}" class="btn btn-primary" class="text-center">Pay Here</a>
        </div>
    </div>
@endsection
