<?php

namespace App\Validations;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class QuantityValidator
{
    /**
     * Register a custom Laravel validation rule to check that the quantity of a
     * product being added to a bill is not greater than the available quantity of
     * that product.
     */
    public static function apply(): void
    {
        Validator::extend('check_quantity', function ($key, $value, $attribute) {
            throw_if(count($attribute) != 1, 'Invalid attribute format.');

            $product = Product::where('product_id', $attribute[0])->first();

            return $product && $value <= $product->quantity;
        });
    }
}
