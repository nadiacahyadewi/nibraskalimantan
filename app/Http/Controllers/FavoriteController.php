<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Favorite;
use App\Models\Product;

class FavoriteController extends Controller
{
    private function getFavoritesQuery()
    {
        if (Auth::check()) {
            return Favorite::where('user_id', Auth::id());
        }
        return Favorite::where('session_id', Session::getId());
    }

    public function index()
    {
        $favorites = $this->getFavoritesQuery()
            ->with(['product.images', 'product.variants', 'product.categoryData', 'product.brand'])
            ->whereHas('product')
            ->latest()
            ->paginate(12);

        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $productId = $request->product_id;

        if (Auth::check()) {
            $favorite = Favorite::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();
        } else {
            $favorite = Favorite::where('session_id', Session::getId())
                ->where('product_id', $productId)
                ->first();
        }

        if ($favorite) {
            $favorite->delete();
            $isFavorited = false;
            $message = 'Produk dihapus dari Favorit.';
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'session_id' => Auth::check() ? null : Session::getId(),
                'product_id' => $productId,
            ]);
            $isFavorited = true;
            $message = 'Produk berhasil ditambahkan ke Favorit!';
        }

        $totalCount = $this->getFavoritesQuery()->count();

        return response()->json([
            'success' => true,
            'is_favorited' => $isFavorited,
            'count' => $totalCount,
            'message' => $message,
        ]);
    }

    public function remove(Request $request, $id)
    {
        $favorite = $this->getFavoritesQuery()->findOrFail($id);
        $favorite->delete();

        if ($request->wantsJson() || $request->ajax()) {
            $totalCount = $this->getFavoritesQuery()->count();
            return response()->json([
                'success' => true,
                'count' => $totalCount,
                'message' => 'Produk dihapus dari Favorit.'
            ]);
        }

        return back()->with('success', 'Produk berhasil dihapus dari Favorit.');
    }
}
