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
        $activeOrders = Order::whereNotIn('status', ['Selesai', 'Dibatalkan'])->count();
        $totalCustomers = User::where('role', '!=', 'admin')->count();
        
        // New Statistics
        $pendingConfirmation = Order::where('status', 'Menunggu Konfirmasi')->count();

        // Recent Orders
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Recent Customers
        $recentCustomers = User::where('role', '!=', 'admin')
            ->latest()
            ->take(5)
            ->get();

        // Top Selling Products
        $topProducts = \App\Models\OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with(['product.images'])
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'activeOrders',
            'totalCustomers',
            'recentOrders',
            'recentCustomers',
            'topProducts',
            'pendingConfirmation'
        ));
    }
}
