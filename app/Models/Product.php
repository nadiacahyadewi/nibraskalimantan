<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 
        'size_xs', 'size_s', 'size_m', 'size_l', 'size_xl', 'size_xxl', 
        'color', 'category', 'category_id', 'brand_id'
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

    public function getTotalStockAttribute()
    {
        return $this->size_xs + $this->size_s + $this->size_m + $this->size_l + $this->size_xl + $this->size_xxl;
    }
}
