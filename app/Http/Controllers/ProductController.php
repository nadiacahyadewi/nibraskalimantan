<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['images', 'categoryData', 'brand']);

        // Handle array of category_id
        if ($request->filled('category_id')) {
            $query->whereIn('category_id', (array) $request->category_id);
        }

        // Handle array of brand_id
        if ($request->filled('brand_id')) {
            $query->whereIn('brand_id', (array) $request->brand_id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter Range Harga
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $minPrice = $request->input('min_price', 0);
            $maxPrice = $request->input('max_price', 999999999);
            
            // Clean up formatting if user inputs like 100.000
            $minPrice = (int) str_replace(['Rp', '.', ',', ' '], '', $minPrice);
            $maxPrice = (int) str_replace(['Rp', '.', ',', ' '], '', $maxPrice);

            $query->whereHas('variants', function ($q) use ($minPrice, $maxPrice) {
                $q->where('stock', '>', 0)
                  ->where(function ($subQ) use ($minPrice, $maxPrice) {
                      // Cek harga diskon jika ada diskon
                      $subQ->where(function ($q2) use ($minPrice, $maxPrice) {
                          $q2->where('discount_price', '>', 0)
                             ->whereBetween('discount_price', [$minPrice, $maxPrice]);
                      })
                      // Cek harga normal jika tidak ada diskon
                      ->orWhere(function ($q2) use ($minPrice, $maxPrice) {
                          $q2->where(function ($q3) {
                              $q3->whereNull('discount_price')->orWhere('discount_price', 0);
                          })->whereBetween('price', [$minPrice, $maxPrice]);
                      });
                  });
            });
        }

        // Sorting logic
        $sort = $request->input('sort', 'terbaru');
        
        if ($sort == 'diskon') {
            $query->whereHas('variants', function ($q) {
                $q->where('discount_price', '>', 0)->where('stock', '>', 0);
            });
            $query->latest();
        } elseif ($sort == 'terlama') {
            $query->oldest();
        } elseif ($sort == 'nama_a_z') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'nama_z_a') {
            $query->orderBy('name', 'desc');
        } else {
            $query->latest(); // Default: terbaru
        }

        $products = $query->paginate(12)->withQueryString();
        
        $categories = Category::all();
        $brands = Brand::all();
        
        // Pastikan selected filter berbentuk array
        $selectedCategory = (array) $request->input('category_id', []);
        $selectedBrand = (array) $request->input('brand_id', []);
        
        $search = $request->input('search');

        return view('products.index', compact('products', 'categories', 'brands', 'selectedCategory', 'selectedBrand', 'search', 'sort'));
    }

    public function show($id)
    {
        $product = Product::with(['images', 'categoryData', 'brand'])->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
