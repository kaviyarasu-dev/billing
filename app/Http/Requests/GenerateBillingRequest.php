<?php

namespace App\Http\Requests;

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
        $rules = [
            'email' => 'required|email',
            'product-id' => 'required|array|min:1',
            'quantity' => 'required|array|min:1',
            'product-id.*' => 'required|exists:products,product_id',
            'denomination' => 'required|array|min:1',
            'denomination.*' => 'required|numeric|min:0',
            'paid' => 'required|numeric|min:1',
        ];

        if ($this->input('product-id')) {
            foreach ($this->input('product-id') as $productId) {
                $rules += [
                    'quantity.*' => [
                        'required',
                        'numeric',
                        'min:1',
                        'check_quantity:' . $productId,
                    ],
                ];
            }
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'email' => 'Email',
            'product-id' => 'Product ID',
            'quantity' => 'Quantity',
            'denomination' => 'Denomination',
            'paid' => 'Paid',
        ];
    }
}
