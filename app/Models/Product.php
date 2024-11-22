<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_id',
        'quantity',
        'price',
        'tax',
    ];

    /**
     * Handle the Product "booted" event.
     *
     * Generate a product_id when creating a new product
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function ($product) {
            $lastId = Product::max('id') ?? 0;
            $nextId = $lastId + 1;
            $product->product_id = sprintf('PRD%04d', $nextId);
        });
    }
}
