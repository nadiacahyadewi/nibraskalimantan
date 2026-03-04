<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('images')->latest();

        if ($request->filled('kategori')) {
            $query->where('category', $request->kategori);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(20)->withQueryString();
        $category = $request->input('kategori');
        $search = $request->input('search');

        return view('products.index', compact('products', 'category', 'search'));
    }

    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
