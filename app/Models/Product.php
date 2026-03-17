<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'purchase_price', 
        'color', 'category', 'category_id', 'brand_id'
        // size_xs to size_xxl is now deprecated in favor of variants
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function categoryData()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function getTotalStockAttribute()
    {
        // Calculate total stock from variants
        return $this->variants()->sum('stock');
    }

    public function getPriceRangeAttribute()
    {
        $availableVariants = $this->variants->where('stock', '>', 0);
        
        if ($availableVariants->count() == 0) {
            return 'Rp ' . number_format($this->price, 0, ',', '.');
        }

        $prices = $availableVariants->map(function($variant) {
            return $variant->effective_price;
        });

        $minPrice = $prices->min();
        $maxPrice = $prices->max();

        if ($minPrice == $maxPrice) {
            return 'Rp ' . number_format($minPrice, 0, ',', '.');
        }

        return 'Rp ' . number_format($minPrice, 0, ',', '.') . ' - Rp ' . number_format($maxPrice, 0, ',', '.');
    }

    public function getMinPriceAttribute()
    {
        $availableVariants = $this->variants->where('stock', '>', 0);

        if ($availableVariants->count() == 0) {
            return 'Rp ' . number_format($this->price, 0, ',', '.');
        }

        $minPrice = $availableVariants->map(function($variant) {
            return $variant->effective_price;
        })->min();

        return 'Rp ' . number_format($minPrice, 0, ',', '.');
    }

    public function getOriginalMinPriceAttribute()
    {
        $availableVariants = $this->variants->where('stock', '>', 0);

        if ($availableVariants->count() == 0) {
            return 'Rp ' . number_format($this->price, 0, ',', '.');
        }

        $minPrice = $availableVariants->pluck('price')->min();

        return 'Rp ' . number_format($minPrice, 0, ',', '.');
    }

    public function getHasDiscountAttribute()
    {
        return $this->variants->where('stock', '>', 0)->contains(function($v) { 
            return $v->has_discount; 
        });
    }

    public function getOriginalPriceRangeAttribute()
    {
        $availableVariants = $this->variants->where('stock', '>', 0);

        if ($availableVariants->count() == 0) {
            return 'Rp ' . number_format($this->price, 0, ',', '.');
        }

        $prices = $availableVariants->pluck('price');

        $minPrice = $prices->min();
        $maxPrice = $prices->max();

        if ($minPrice == $maxPrice) {
            return 'Rp ' . number_format($minPrice, 0, ',', '.');
        }

        return 'Rp ' . number_format($minPrice, 0, ',', '.') . ' - Rp ' . number_format($maxPrice, 0, ',', '.');
    }
}
