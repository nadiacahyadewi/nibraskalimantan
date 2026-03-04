<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.navbar', function ($view) {
            $cartItemsCount = 0;
            
            if (Auth::check()) {
                $cart = Cart::with('items')->where('user_id', Auth::id())->first();
            } else {
                $cart = Cart::with('items')->where('session_id', Session::getId())->first();
            }

            if ($cart) {
                $cartItemsCount = $cart->items->sum('quantity');
            }

            $view->with('cartItemsCount', $cartItemsCount);
        });
    }
}
