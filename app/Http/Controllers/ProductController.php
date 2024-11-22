<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified product.
     *
     * @param \App\Models\Product $product
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return $this->successResponse($product, __('messages.product_retrieved'));
    }
}
