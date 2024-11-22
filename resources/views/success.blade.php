@extends('layouts.app')

@section('content')

    <div class="result-section">
        <h3>Bill Summary</h3>

        <div>
            <p>Customer Email: {{ $order->email }}</p>
            <p>Order Amount: {{ $order->amount }}</p>
            <p>Given Amount: {{ $order->paid }}</p>
            <p>Balance Amount: {{ $order->balance }}</p>
        </div>
    </div>

    <div class="result-section">
        <h3>Balance Denominations</h3>
        <div>
            @foreach ($order->available_denominations as $value)
                <p>{{ $value['denomination'] }} X {{ $value['count'] }} = {{ $value['denomination'] * $value['count'] }}</p>
            @endforeach
        </div>
    </div>

@endsection
