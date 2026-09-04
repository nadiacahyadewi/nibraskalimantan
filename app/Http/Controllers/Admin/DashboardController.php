<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $totalProducts = Product::count();
        $totalCategories = \App\Models\Category::count();
        $totalBrands = \App\Models\Brand::count();
        
        // Stok yang sedang menipis
        $lowStockProducts = Product::with(['images', 'categoryData', 'brand'])
            ->withSum('variants', 'stock')
            ->orderBy('variants_sum_stock', 'asc')
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalBrands',
            'lowStockProducts'
        ));
    }
}
