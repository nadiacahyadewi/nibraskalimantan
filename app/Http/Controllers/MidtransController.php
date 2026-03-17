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

            // Always generate a new unique ID for Midtrans to allow retries/re-clicks
            // Midtrans rejects the same order_id if parameters or state changed (or in some sandbox cases)
            $order->update(['midtrans_order_id' => $order->id . '-' . time()]);

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

            // Extract payment info
            $paymentInfo = '';
            if ($type == 'bank_transfer') {
                if (isset($status->va_numbers[0])) {
                    $paymentInfo = strtoupper($status->va_numbers[0]->bank) . ' (VA: ' . $status->va_numbers[0]->va_number . ')';
                } elseif (isset($status->permata_va_number)) {
                    $paymentInfo = 'PERMATA (VA: ' . $status->permata_va_number . ')';
                }
            } elseif ($type == 'cstore') {
                $paymentInfo = strtoupper($status->store);
            } elseif ($type == 'credit_card') {
                $paymentInfo = strtoupper($status->bank);
            } elseif (in_array($type, ['gopay', 'shopeepay', 'qris'])) {
                $paymentInfo = strtoupper($type);
            }

            $updateData = [
                'status' => $newStatus,
                'payment_type' => $type,
                'payment_info' => $paymentInfo ?: null
            ];

            if ($newStatus === 'Dibayar' && $oldStatus !== 'Dibayar') {
                $updateData['paid_at'] = now();
            }

            $order->update($updateData);

            if ($newStatus !== $oldStatus) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status berhasil diperbarui menjadi: ' . $newStatus,
                    'new_status' => $newStatus
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Status sudah sesuai ('. $oldStatus .'). Data pembayaran diperbarui.',
                'new_status' => $oldStatus
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function notification(Request $request)
    {
        \Log::info('Midtrans Notification Received:', $request->all());
        try {
            $notif = new \Midtrans\Notification();

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $order_id = explode('-', $notif->order_id)[0];
            $fraud = $notif->fraud_status;

            $order = Order::findOrFail($order_id);

            $newStatus = $order->status;
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
            } else if (in_array($transaction, ['deny', 'expire', 'cancel'])) {
                $newStatus = 'Dibatalkan';
            }

            // Extract payment info
            $paymentInfo = '';
            if ($type == 'bank_transfer') {
                if (isset($notif->va_numbers[0])) {
                    $paymentInfo = strtoupper($notif->va_numbers[0]->bank) . ' (VA: ' . $notif->va_numbers[0]->va_number . ')';
                } elseif (isset($notif->permata_va_number)) {
                    $paymentInfo = 'PERMATA (VA: ' . $notif->permata_va_number . ')';
                }
            } elseif ($type == 'cstore') {
                $paymentInfo = strtoupper($notif->store);
            } elseif ($type == 'credit_card') {
                $paymentInfo = strtoupper($notif->bank);
            } elseif (in_array($type, ['gopay', 'shopeepay', 'qris'])) {
                $paymentInfo = strtoupper($type);
            }

            $updateData = [
                'status' => $newStatus,
                'payment_type' => $type,
                'payment_info' => $paymentInfo ?: null
            ];

            if ($newStatus === 'Dibayar' && $order->status !== 'Dibayar') {
                $updateData['paid_at'] = now();
            }

            $order->update($updateData);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            \Log::error('Midtrans Notification Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
