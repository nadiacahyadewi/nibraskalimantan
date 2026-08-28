<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    private function getCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        }
        return Cart::firstOrCreate(['session_id' => Session::getId()]);
    }

    public function index()
    {
        $cart = $this->getCart();
        $cartItems = $cart->items()->with('product.images', 'product.variants')->get();

        $subtotal = 0;
        $baseSubtotal = 0;
        foreach ($cartItems as $item) {
            $variant = $item->product->variants->where('size', $item->size)->first();
            $effectivePrice = $variant ? $variant->effective_price : $item->product->price;
            $originalPrice = $variant ? $variant->price : $item->product->price;

            $subtotal += $effectivePrice * $item->quantity;
            $baseSubtotal += $originalPrice * $item->quantity;
        }

        $totalQty = $cartItems->sum('quantity');

        return view('cart.index', compact('cartItems', 'subtotal', 'baseSubtotal', 'totalQty'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'qty' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Validate stock
        $variant = $product->variants()->where('size', $request->size)->first();
        if (!$variant) {
            return back()->with('error', 'Ukuran varian tidak ditemukan.');
        }

        $availableStock = $variant->stock;

        if ($availableStock < $request->qty) {
            return back()->with('error', 'Stok tidak mencukupi untuk ukuran ' . $request->size);
        }

        $cart = $this->getCart();

        $cartItem = $cart->items()->where('product_id', $product->id)->where('size', $request->size)->first();

        if ($cartItem) {
            // Update quantity if already exists
            $newQty = $cartItem->quantity + $request->qty;
            if ($newQty > $availableStock) {
                $newQty = $availableStock; // Cap at max stock
            }
            $cartItem->update(['quantity' => $newQty]);
        } else {
            // Create new item
            $cart->items()->create([
                'product_id' => $product->id,
                'size' => $request->size,
                'quantity' => $request->qty
            ]);
        }

        if ($request->has('redirect_to_cart') && $request->redirect_to_cart == '1') {
            return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::findOrFail($id);
        
        // Check permissions (ensure the user owns this cart)
        $cart = $this->getCart();
        if ($cartItem->cart_id !== $cart->id) {
            return back()->with('error', 'Tidak berhak.');
        }

        // Validate stock
        $product = $cartItem->product;
        $variant = $product->variants()->where('size', $cartItem->size)->first();
        $availableStock = $variant ? $variant->stock : 0;

        $qty = $request->quantity;
        if ($qty > $availableStock) {
            $qty = $availableStock;
        }

        $cartItem->update(['quantity' => $qty]);

        return back()->with('success', 'Kuantitas diperbarui.');
    }

    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);
        
        // Check permissions (ensure the user owns this cart)
        $cart = $this->getCart();
        if ($cartItem->cart_id === $cart->id) {
            $cartItem->delete();
        }

        return back()->with('success', 'Item dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $cart = $this->getCart();
        $cartItems = $cart->items()->with('product.images', 'product.variants', 'product.categoryData')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = 0;
        $baseSubtotal = 0;
        $totalWeight = 0;

        $categoryWeights = [
            'Jilbab' => 150,
            'Koko Dewasa' => 500,
            'Gamis Dewasa' => 500,
            'Gamis Anak' => 500,
            'Koko Anak' => 500,
            'Kaos Kaki' => 100,
            'Ciput' => 80,
            'Sarung' => 500,
            'Baju Olahraga' => 500,
            'Mukena' => 500,
            'Inner' => 120,
            'Atasan Pria' => 500,
            'Atasan Wanita' => 500,
        ];

        foreach ($cartItems as $item) {
            $variant = $item->product->variants->where('size', $item->size)->first();
            $effectivePrice = $variant ? $variant->effective_price : $item->product->price;
            $originalPrice = $variant ? $variant->price : $item->product->price;

            $subtotal += $effectivePrice * $item->quantity;
            $baseSubtotal += $originalPrice * $item->quantity;

            $catName = $item->product->categoryData ? $item->product->categoryData->name : ($item->product->category ?? '');
            
            // Gunakan berat dari kolom produk jika tersedia, jika tidak gunakan logika kategori
            $weightPerItem = $item->product->weight > 0 ? $item->product->weight : 500;
            
            if ($item->product->weight <= 0) {
                foreach ($categoryWeights as $cat => $w) {
                    if (stripos($catName, $cat) !== false) {
                        $weightPerItem = $w;
                        break;
                    }
                }
            }
            
            $totalWeight += $weightPerItem * $item->quantity;
        }

        $totalQty = $cartItems->sum('quantity');

        return view('checkout.index', compact('cartItems', 'subtotal', 'baseSubtotal', 'totalQty', 'totalWeight'));
    }
    public function processCheckout(Request $request)
    {
        \Log::info('Processing Checkout Request:', $request->all());

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Checkout Validation Failed:', $e->errors());
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }

        $cart = $this->getCart();
        $cartItems = $cart->items()->with('product.variants')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $totalAmount = 0;

        // Calculate total amount and prepare order items data
        $orderItemsData = [];
        foreach ($cartItems as $item) {
            $variant = $item->product->variants->where('size', $item->size)->first();
            $price = $variant ? $variant->effective_price : $item->product->price;
            
            $totalAmount += $price * $item->quantity;

            $orderItemsData[] = [
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'size' => $item->size,
                'quantity' => $item->quantity,
                'price' => $price,
            ];

            // Deduct stock
            if ($variant) {
                $variant->stock = max(0, $variant->stock - $item->quantity);
                $variant->save();
            }
        }

        // Create Order
        $order = \App\Models\Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->name,
            'customer_phone' => $request->phone,
            'customer_address' => $request->address,
            'province' => '-',
            'city' => '-',
            'district' => '-',
            'courier' => 'Manual',
            'shipping_service' => 'WhatsApp',
            'shipping_cost' => 0,
            'total_amount' => $totalAmount,
            'status' => 'Menunggu Konfirmasi',
            'payment_method' => 'Manual Transfer'
        ]);

        // Create Order Items
        foreach ($orderItemsData as $itemData) {
            $order->items()->create($itemData);
        }

        // Clear cart
        $cart->items()->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat.',
                'order_id' => $order->id,
                'redirect_url' => url('/') // We might not have ajax redirect to WA directly, or we can. Let's return WA URL
            ]);
        }

        // Create WhatsApp Message
        $itemsText = "";
        foreach ($orderItemsData as $item) {
            $itemsText .= "- " . $item['product_name'] . " (" . $item['size'] . ") x" . $item['quantity'] . "\n";
        }
        $totalFmt = number_format($totalAmount, 0, ',', '.');
        
        $waMessage = "Halo Admin, saya tertarik dengan daftar produk berikut:\n\n";
        $waMessage .= "Nama: {$request->name}\n";
        $waMessage .= "No. HP: {$request->phone}\n";
        $waMessage .= "Alamat: {$request->address}\n\n";
        $waMessage .= "Daftar Produk:\n" . $itemsText . "\n";
        $waMessage .= "Total Harga: Rp " . $totalFmt . "\n\n";
        $waMessage .= "Mohon info ketersediaan stok, ongkos kirim, dan totalnya ya. Terima kasih.";
        
        // Ambil nomor admin dari database (tabel settings)
        $adminPhone = \App\Models\Setting::where('key', 'wa_admin_1')->value('value') ?? '6289523195549';
        $waUrl = "https://wa.me/{$adminPhone}?text=" . urlencode($waMessage);

        return redirect()->away($waUrl);
    }
}
