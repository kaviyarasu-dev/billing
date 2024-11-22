<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = ['email', 'amount', 'paid'];

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function denominations(): HasMany
    {
        return $this->hasMany(Denomination::class);
    }

    /**
     * Get the balance amount for the order.
     *
     * This attribute calculates the difference between the total amount and the
     * paid amount for the order, returning the absolute value as a float.
     *
     * @return float The balance amount.
     */
    public function getBalanceAttribute(): float
    {
        return abs($this->amount - $this->paid);
    }

    /**
     * Calculate the available denominations for the order's balance.
     *
     * This attribute calculates how the balance amount can be broken down into
     * various denominations. It returns an array where each element represents
     * a denomination and the count of how many times that denomination can be
     * used to make up the balance.
     *
     * @return array<int, array<string, int>> An array of denominations and their counts.
     */
    public function getAvailableDenominationsAttribute(): array
    {
        $balance = $this->balance;
        $denominations = [500, 50, 20, 10, 5, 2, 1];
        $result = [];

        foreach ($denominations as $denomination) {
            $count = floor($balance / $denomination);
            if ($count > 0) {
                $result[] = [
                    'denomination' => $denomination,
                    'count' => $count,
                ];
                $balance -= $denomination * $count;
            }
        }

        return $result;
    }
}
