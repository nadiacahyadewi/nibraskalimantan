<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'size', 'price', 'discount_price', 'purchase_price', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getEffectivePriceAttribute()
    {
        return $this->discount_price > 0 ? $this->discount_price : $this->price;
    }

    public function getHasDiscountAttribute()
    {
        return $this->discount_price > 0;
    }
}
