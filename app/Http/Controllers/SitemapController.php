<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SitemapController extends Controller
{
    public function index()
    {
        // Mendapatkan produk beserta gambar untuk image sitemap
        $products = \App\Models\Product::with('images')->latest()->get();
        
        // Mendapatkan kategori dan brand
        $categories = \App\Models\Category::all();
        $brands = \App\Models\Brand::all();

        return response()->view('sitemap', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ])->header('Content-Type', 'text/xml');
    }
}
