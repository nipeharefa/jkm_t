@extends('layout.app-auth')

@section('content')
    <div class="container">
        <form method="GET" action="{{ route('index.order') }}">
            <input type="search" placeholder="Search Order number here" name="order_number" />
        </form>

        <table class="table tabel-order">
            <thead>
                <td>Order Number</td>
                <td>Description</td>
                <td>Total</td>
                <td>Information</td>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>
                            {{ $order->description }}
                        </td>
                        <td>{{ $order->total }}</td>
                        <td>
                            @switch($order->status)
                                @case('waiting_payment')
                                    <a href="{{ route('create.payment') }}" class="btn btn-primary">Pay</a>
                                    @break
                                @case('success')
                                    @if ($order->type === 'product_commerce')
                                        Shipping Code : {{ $order->productCommerce->shippingCode }}
                                    @else
                                        Success
                                    @endif
                                    @break
                                @case('fail')
                                    Fail
                                    @break
                                @case('canceled')
                                    <p class="warning">Canceled</p>
                                    @break
                                @default
                            @endswitch
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
    </div>
@endsection
