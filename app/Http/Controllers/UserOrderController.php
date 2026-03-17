<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product.images')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product.images')->findOrFail($id);

        // Authorization check
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('orders.show', compact('order'));
    }

    public function complete(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'Dikirim') {
            return back()->with('error', 'Pesanan tidak bisa diselesaikan pada status ini.');
        }

        $order->update([
            'status' => 'Selesai',
            'completed_at' => now()
        ]);

        return back()->with('success', 'Terima kasih! Pesanan Anda telah selesai.');
    }
}
