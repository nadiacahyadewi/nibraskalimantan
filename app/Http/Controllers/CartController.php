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
        $cartItems = $cart->items()->with('product.images')->get();

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->product->price * $item->quantity;
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
        $sizeField = 'size_' . strtolower($request->size);
        $availableStock = $product->$sizeField ?? 0;

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
        $sizeField = 'size_' . strtolower($cartItem->size);
        $availableStock = $product->$sizeField ?? 0;

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

    public function checkout()
    {
        // For now, this just shows a placeholder alert or redirects.
        // In a real app, it would show a checkout form or redirect to WhatsApp.
        return redirect()->route('cart.index')->with('info', 'Halaman Checkout dalam pengembangan.');
    }
}
