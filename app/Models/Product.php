<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 
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
        if ($this->variants()->count() == 0) {
            return 'Rp ' . number_format($this->price, 0, ',', '.');
        }

        $minPrice = $this->variants()->min('price');
        $maxPrice = $this->variants()->max('price');

        if ($minPrice == $maxPrice) {
            return 'Rp ' . number_format($minPrice, 0, ',', '.');
        }

        return 'Rp ' . number_format($minPrice, 0, ',', '.') . ' - Rp ' . number_format($maxPrice, 0, ',', '.');
    }
}
