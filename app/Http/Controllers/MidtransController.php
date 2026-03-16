<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function getToken(Request $request)
    {
        try {
            $order = Order::with('items')->findOrFail($request->order_id);

            $item_details = $order->items->map(function ($item) {
                return [
                    'id' => $item->product_id,
                    'price' => (int) $item->price,
                    'quantity' => $item->quantity,
                    'name' => substr($item->product_name, 0, 50),
                ];
            })->toArray();

            if ($order->shipping_cost > 0) {
                $item_details[] = [
                    'id' => 'shipping',
                    'price' => (int) $order->shipping_cost,
                    'quantity' => 1,
                    'name' => 'Ongkos Kirim (' . substr($order->courier, 0, 30) . ')',
                ];
            }

            // Calculate item total to ensure it matches gross_amount
            $itemTotal = 0;
            foreach ($item_details as $item) {
                $itemTotal += $item['price'] * $item['quantity'];
            }

            // Persistence: Use existing midtrans_order_id if available, otherwise create new
            if (!$order->midtrans_order_id) {
                $order->update(['midtrans_order_id' => $order->id . '-' . time()]);
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $order->midtrans_order_id,
                    'gross_amount' => (int) $itemTotal, // Use calculated total to be safe
                ],
                'customer_details' => [
                    'first_name' => $order->customer_name,
                    'phone' => $order->customer_phone,
                ],
                'item_details' => $item_details,
            ];

            if ($order->user && $order->user->email) {
                $params['customer_details']['email'] = $order->user->email;
            }

            \Log::info('Midtrans Request Params:', $params);

            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            \Log::error('Midtrans Snap Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkStatus(Request $request)
    {
        try {
            $order = Order::findOrFail($request->order_id);
            
            // Check if current payment method is Midtrans
            if ($order->payment_method !== 'Midtrans') {
                return response()->json(['success' => false, 'message' => 'Pesanan ini tidak menggunakan Midtrans.'], 400);
            }

            // Fetch status from Midtrans
            $midtransOrderId = $order->midtrans_order_id ?? $order->id;
            
            // Try with stored ID, fallback to searching logs if still fails (handled by user re-paying)
            try {
                $status = \Midtrans\Transaction::status($midtransOrderId);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Status belum tersedia di Midtrans. Silakan selesaikan pembayaran terlebih dahulu.',
                    'debug_id' => $midtransOrderId
                ], 404);
            }

            $transaction = $status->transaction_status;
            $type = $status->payment_type;
            $fraud = $status->fraud_status;

            $oldStatus = $order->status;
            $newStatus = $oldStatus;

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $newStatus = 'Pending Midtrans';
                    } else {
                        $newStatus = 'Dibayar';
                    }
                }
            } else if ($transaction == 'settlement') {
                $newStatus = 'Dibayar';
            } else if ($transaction == 'pending') {
                $newStatus = 'Menunggu Pembayaran';
            } else if ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
                $newStatus = 'Dibatalkan';
            }

            if ($newStatus !== $oldStatus) {
                $order->update(['status' => $newStatus]);
                return response()->json([
                    'success' => true,
                    'message' => 'Status berhasil diperbarui menjadi: ' . $newStatus,
                    'new_status' => $newStatus
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Status sudah sesuai ('. $oldStatus .'). Tidak ada perubahan.',
                'new_status' => $oldStatus
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function notification(Request $request)
    {
        \Log::info('Midtrans Notification Received:', $request->all());
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = explode('-', $notif->order_id)[0];
        $fraud = $notif->fraud_status;

        $order = Order::findOrFail($order_id);

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $order->update(['status' => 'Pending Midtrans']);
                } else {
                    $order->update(['status' => 'Dibayar']);
                }
            }
        } else if ($transaction == 'settlement') {
            $order->update(['status' => 'Dibayar']);
        } else if ($transaction == 'pending') {
            $order->update(['status' => 'Menunggu Pembayaran']);
        } else if ($transaction == 'deny') {
            $order->update(['status' => 'Dibatalkan']);
        } else if ($transaction == 'expire') {
            $order->update(['status' => 'Dibatalkan']);
        } else if ($transaction == 'cancel') {
            $order->update(['status' => 'Dibatalkan']);
        }

        return response()->json(['status' => 'success']);
    }
}
