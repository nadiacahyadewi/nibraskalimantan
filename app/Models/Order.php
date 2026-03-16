<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariant;
use App\Models\Finance;

class Order extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'processed_at' => 'datetime',
        'shipped_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Record profit to finances based on the items in the order.
     */
    public function recordProfit()
    {
        // Prevent double recording if needed, though 'Diproses' transition happens once
        $existing = Finance::where('description', 'Keuntungan Penjualan - Pesanan #' . $this->id)->first();
        if ($existing) {
            return;
        }

        $totalProfit = 0;
        foreach ($this->items as $item) {
            $variant = ProductVariant::where('product_id', $item->product_id)
                ->where('size', $item->size)
                ->first();
            
            $purchasePrice = $variant ? $variant->purchase_price : ($item->product ? $item->product->purchase_price : 0);
            $totalProfit += ($item->price - $purchasePrice) * $item->quantity;
        }

        if ($totalProfit > 0) {
            Finance::create([
                'type' => 'pemasukan',
                'amount' => $totalProfit,
                'description' => 'Keuntungan Penjualan - Pesanan #' . $this->id,
                'date' => now()->format('Y-m-d')
            ]);
        }
    }
}
