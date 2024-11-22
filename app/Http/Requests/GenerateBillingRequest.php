<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class GenerateBillingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'product-id.*' => 'required|exists:products,product_id',
            'product-quantity.*' => [
                'required',
                'numeric',
                'min:1',
                function ($attribute, $value, $fail) {
                    $index = explode('.', $attribute)[1] ?? null;
                    $productId = $this->input('product-id')[$index] ?? null;
                    $product = Product::where('product_id', $productId)->first();
                    dd($this->input('product-id'), $attribute, $product);
                    $productId = array_get($this->input('product-id'), $attribute);
                    $product = Product::find($productId);
                    if (!$product || $value > $product->quantity) {
                        $fail('Quantity exceeds available stock.');
                    }
                },
            ],
        ];
    }
}
