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

        // Sorting logic
        $sort = $request->input('sort', 'terbaru');
        if ($sort == 'terlama') {
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
