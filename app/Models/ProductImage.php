<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image_path'];

    public function getUrlAttribute()
    {
        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            return $this->image_path;
        }
        return \Illuminate\Support\Facades\Storage::url($this->image_path);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
