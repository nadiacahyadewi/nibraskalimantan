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
        $query = Product::with(['images', 'categoryData', 'brand'])->latest();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(20)->withQueryString();
        $categories = Category::all();
        $brands = Brand::all();
        $selectedCategory = $request->input('category_id');
        $selectedBrand = $request->input('brand_id');
        $search = $request->input('search');

        return view('products.index', compact('products', 'categories', 'brands', 'selectedCategory', 'selectedBrand', 'search'));
    }

    public function show($id)
    {
        $product = Product::with(['images', 'categoryData', 'brand'])->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
