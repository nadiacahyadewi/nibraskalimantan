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
        foreach ($cartItems as $item) {
            $variant = $item->product->variants->where('size', $item->size)->first();
            $price = $variant ? $variant->price : $item->product->price;
            $subtotal += $price * $item->quantity;
        }

        $totalQty = $cartItems->sum('quantity');

        return view('cart.index', compact('cartItems', 'subtotal', 'totalQty'));
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

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
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
        $totalWeight = 0;

        $categoryWeights = [
            'Jilbab' => 150,
            'Koko Dewasa' => 300,
            'Gamis Dewasa' => 700,
            'Gamis Anak' => 400,
            'Koko Anak' => 200,
            'Kaos Kaki' => 100,
            'Ciput' => 80,
            'Sarung' => 500,
            'Baju Olahraga' => 350,
            'Mukena' => 900,
            'Inner' => 120,
            'Atasan Pria' => 300,
            'Atasan Wanita' => 250,
        ];

        foreach ($cartItems as $item) {
            $variant = $item->product->variants->where('size', $item->size)->first();
            $price = $variant ? $variant->price : $item->product->price;
            $subtotal += $price * $item->quantity;

            $catName = $item->product->categoryData ? $item->product->categoryData->name : ($item->product->category ?? '');
            
            $weightPerItem = 250; // Default weight jika murni tidak didefinisikan
            foreach ($categoryWeights as $cat => $w) {
                if (stripos($catName, $cat) !== false) {
                    $weightPerItem = $w;
                    break;
                }
            }
            
            $totalWeight += $weightPerItem * $item->quantity;
        }

        // Ekspedisi minimal dihitung 1kg (1000g)
        $totalWeight = max($totalWeight, 1000);
        $totalQty = $cartItems->sum('quantity');

        // Ambil data provinsi dari RajaOngkirController
        $rajaOngkir = new \App\Http\Controllers\RajaOngkirController();
        $provincesResponse = $rajaOngkir->index();
        $provinces = $provincesResponse->getData()['provinces'] ?? [];
        
        // Cek jika return view (dari index() original) maka kita perlu extract data provinces-nya
        if ($provincesResponse instanceof \Illuminate\View\View) {
            $provinces = $provincesResponse->getData()['provinces'] ?? [];
        }

        return view('checkout.index', compact('cartItems', 'subtotal', 'totalQty', 'totalWeight', 'provinces'));
    }
    public function processCheckout(Request $request)
    {
        \Log::info('Processing Checkout Request:', $request->all());

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string',
                'payment_method' => 'required|string|in:Midtrans,QRIS,Bank Transfer',
                'province' => 'required|string',
                'city' => 'required|string',
                'district' => 'required|string',
                'courier' => 'required|string',
                'shipping_service' => 'required|string',
                'shipping_cost' => 'required|numeric',
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
            $price = $variant ? $variant->price : $item->product->price;
            
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
            'province' => $request->province,
            'city' => $request->city,
            'district' => $request->district,
            'courier' => $request->courier,
            'shipping_service' => $request->shipping_service,
            'shipping_cost' => $request->shipping_cost,
            'total_amount' => $totalAmount + $request->shipping_cost,
            'status' => 'Menunggu Pembayaran',
            'payment_method' => $request->payment_method
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
                'redirect_url' => route('home')
            ]);
        }

        return redirect()->route('home')->with('success', 'Pesanan Anda berhasil dibuat! Pesanan Anda akan segera diproses.');
    }
}
