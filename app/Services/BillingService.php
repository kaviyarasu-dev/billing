<?php

namespace App\Services;

use App\Http\Requests\GenerateBillingRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class BillingService
{
    /**
     * Generates a bill for a customer based on products and quantities specified in the request.
     *
     * @param \App\Http\Requests\GenerateBillingRequest $request
     *
     * @return \App\Models\Order
     */
    public function invoice(GenerateBillingRequest $request)
    {
        return DB::transaction(function () use ($request, &$order) {
            $data = $request->validated();
            $total = $this->calculateOrderTotal($data);

            $order = Order::create(['amount' => $total, ...$data]);

            $products = Product::whereIn('product_id', $data['product-id'])->pluck('id', 'product_id')->toArray();
            foreach ($data['product-id'] as $key => $productId) {
                $order->orderDetails()->create(['product_id' => $products[$productId], 'quantity' => $data['quantity'][$key]]);
            }

            foreach ($data['denomination'] as $denomination => $count) {
                $order->denominations()->create(['denomination_value' => $denomination, 'count' => $count]);
            }

            return $order;
        });
    }

    /**
     * Calculate the total amount for the order given the provided data.
     *
     * @param  array  $data
     * @return float
     */
    private function calculateOrderTotal(array $data): float
    {
        $total = 0;

        foreach ($data['product-id'] as $productId) {
            $product = Product::where('product_id', $productId)->first();

            $subTotal = $product->price * $product->quantity;
            $taxAmount = $subTotal * $product->tax / 100;
            $total += $subTotal + $taxAmount;
        }

        return round($total, 2);
    }
}
