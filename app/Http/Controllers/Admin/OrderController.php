<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'active');
        
        $query = Order::query();
        
        if ($tab === 'history') {
            $query->whereIn('status', ['Selesai', 'Dibatalkan']);
        } else {
            $query->whereIn('status', ['Menunggu Konfirmasi', 'Diproses', 'Dikirim']);
        }

        $orders = $query->latest()->paginate(15);
        $orders->appends(['tab' => $tab]);

        return view('admin.orders.index', compact('orders', 'tab'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product.images', 'items.product.variants']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Konfirmasi,Diproses,Dikirim,Selesai,Dibatalkan'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
