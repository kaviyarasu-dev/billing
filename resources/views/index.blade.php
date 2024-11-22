@extends('layouts.app')

@section('content')
<h1>Billing Calculation</h1>

    <form id="billing-form" action="{{ route('billing.generate') }}" method="POST">
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
                <label>₹500</label>
                <input type="number" id="denom-500" placeholder="Count">
            </div>
            <div class="denomination-row">
                <label>₹200</label>
                <input type="number" id="denom-200" placeholder="Count">
            </div>
            <div class="denomination-row">
                <label>₹100</label>
                <input type="number" id="denom-100" placeholder="Count">
            </div>
            <div class="denomination-row">
                <label>₹50</label>
                <input type="number" id="denom-50" placeholder="Count">
            </div>
            <div class="denomination-row">
                <label>₹20</label>
                <input type="number" id="denom-20" placeholder="Count">
            </div>
            <div class="denomination-row">
                <label>₹10</label>
                <input type="number" id="denom-10" placeholder="Count">
            </div>
        </div>

        <!-- Amount Given Section -->
        <div class="form-section">
            <h3>Payment</h3>
            <label for="amount-given">Amount Given by Customer:</label>
            <input type="number" id="amount-given" placeholder="Enter amount">
            <button type="submit" id="generate-bill">Generate Bill</button>
        </div>
    </form>
    <!-- Result Section -->
    <div id="result" class="result-section" style="display: none;">
        <h3>Bill Summary</h3>
        <p id="bill-details"></p>
    </div>
@endsection

@section('script')
<script>
    const getProductUrl = "{{ route('products.show', ':productId') }}";
</script>
<script src="{{ asset('assets/js/billing.js') }}"></script>
@endsection
