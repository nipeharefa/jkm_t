@extends('layout.app')

@section('content')
    @include('erros.error')

    <form method="POST" action="{{ route('store.prepaid-balance') }}">

        <div class="form-group">
            <label>Mobile Phone Number</label>
            <input type="text" placeholder="" required name="phone_number" class="form-control" autocomplete="off"/>
        </div>

        <div class="form-group">
            <label>Value</label>
            <select name="value" class="form-control">
                <option value="10000">10.000</option>
                <option value="50000">50.000</option>
                <option value="100000">100.000</option>
            </select>
        </div>
        {{ csrf_field() }}

        <div class="form-group">
            <input type="submit" class="btn btn-primary" />
        </div>

    </form>
@endsection
