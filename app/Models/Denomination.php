<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Denomination extends Model
{
    protected $fillable = [
        'denomination_value',
        'count',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
