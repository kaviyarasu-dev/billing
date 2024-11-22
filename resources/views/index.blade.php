@extends('layouts.app')

@section('content')
<h1>Billing Calculation</h1>

    <form id="billing-form" action="{{ route('billing.generate') }}" method="POST">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="error-message">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @csrf
        <!-- Customer Details Section -->
        <div class="form-section">
            <h3>Customer Details</h3>
            <label for="customer-email">Customer Email:</label>
            <input type="email" name="email" id="customer-email" placeholder="Enter customer email">
        </div>

        <!-- Products Section -->
        <div class="form-section">
            <h3>Products</h3>
            <div id="products-list">
                <!-- Dynamic product rows will be added here -->
            </div>
            <button type="button" id="add-product">Add New Product</button>
        </div>

        <!-- Denominations Section -->
        <div class="form-section">
            <h3>Denominations</h3>
            <div class="denomination-row">
                <label for="denom-500">₹500</label>
                <input type="number" name="denomination[500]" id="denom-500" placeholder="Count" value="0">
            </div>
            <div class="denomination-row">
                <label for="denom-50">₹50</label>
                <input type="number" name="denomination[50]" id="denom-50" placeholder="Count" value="0">
            </div>
            <div class="denomination-row">
                <label for="denom-20">₹20</label>
                <input type="number" name="denomination[20]" id="denom-20" placeholder="Count" value="0">
            </div>
            <div class="denomination-row">
                <label for="denom-10">₹10</label>
                <input type="number" name="denomination[10]" id="denom-10" placeholder="Count" value="0">
            </div>
            <div class="denomination-row">
                <label for="denom-5">₹5</label>
                <input type="number" name="denomination[5]" id="denom-5" placeholder="Count" value="0">
            </div>
            <div class="denomination-row">
                <label for="denom-2">₹2</label>
                <input type="number" name="denomination[2]" id="denom-2" placeholder="Count" value="0">
            </div>
            <div class="denomination-row">
                <label for="denom-1">₹1</label>
                <input type="number" name="denomination[1]" id="denom-1" placeholder="Count" value="0">
            </div>
        </div>

        <!-- Amount Given Section -->
        <div class="form-section">
            <h3>Payment</h3>
            <label for="amount-given">Amount Given by Customer:</label>
            <input type="number" name="paid" id="amount-given" placeholder="Enter amount">
            <button type="submit" id="generate-bill">Generate Bill</button>
        </div>
    </form>
@endsection

@section('script')
<script>
    const getProductUrl = "{{ route('products.show', ':productId') }}";
</script>
<script src="{{ asset('assets/js/billing.js') }}"></script>
@endsection
