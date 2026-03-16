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
            $query->whereIn('status', ['Menunggu Pembayaran', 'Dibayar', 'Menunggu Konfirmasi', 'Diproses', 'Dikirim']);
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
            'status' => 'required|in:Menunggu Pembayaran,Dibayar,Menunggu Konfirmasi,Diproses,Dikirim,Selesai,Dibatalkan'
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;
        $updateData = ['status' => $newStatus];

        // Requirement: Profit recording & timestamp happens when status is set to 'Diproses'
        if ($newStatus === 'Diproses' && $oldStatus !== 'Diproses') {
            $order->recordProfit();
            $updateData['processed_at'] = now();
        }

        // Requirement: Profit removal & timestamp happens when status is set to 'Dibatalkan'
        if ($newStatus === 'Dibatalkan' && $oldStatus !== 'Dibatalkan') {
            \App\Models\Finance::where('description', 'Keuntungan Penjualan - Pesanan #' . $order->id)->delete();
            $updateData['cancelled_at'] = now();
        }

        // Additional status timestamps
        if ($newStatus === 'Selesai' && $oldStatus !== 'Selesai') {
            $updateData['completed_at'] = now();
        }

        $order->update($updateData);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function ship(Request $request, Order $order)
    {
        $request->validate([
            'receipt_number' => 'required|string|max:255'
        ]);

        $order->update([
            'status' => 'Dikirim',
            'receipt_number' => $request->receipt_number,
            'shipped_at' => now()
        ]);

        // Note: For admin, this is "done", but status remains "Dikirim" for customer
        return back()->with('success', 'Pesanan telah dikirim dengan nomor resi: ' . $request->receipt_number);
    }
}
