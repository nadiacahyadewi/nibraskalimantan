<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Cart;
use App\Models\Favorite;

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
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject('Permintaan Reset Password')
                ->greeting('Halo!')
                ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda di Nibras Kalimantan.')
                ->action('Reset Password', $url)
                ->line('Tautan reset password ini akan kedaluwarsa dalam 5 menit.')
                ->line('Jika Anda tidak merasa melakukan permintaan ini, tidak ada tindakan lebih lanjut yang perlu dilakukan.')
                ->salutation('Salam Hangat, Tim Nibras Kalimantan');
        });

        View::composer('layouts.navbar', function ($view) {
            $cartItemsCount = 0;
            $favoritesCount = 0;
            
            if (Auth::check()) {
                $cart = Cart::with('items')->where('user_id', Auth::id())->first();
                $favoritesCount = Favorite::where('user_id', Auth::id())->count();
            } else {
                $cart = Cart::with('items')->where('session_id', Session::getId())->first();
                $favoritesCount = Favorite::where('session_id', Session::getId())->count();
            }

            if ($cart) {
                $cartItemsCount = $cart->items->sum('quantity');
            }

            $view->with([
                'cartItemsCount' => $cartItemsCount,
                'favoritesCount' => $favoritesCount,
            ]);
        });

        View::composer(['welcome', 'products.*', 'favorites.index'], function ($view) {
            if (Auth::check()) {
                $favoriteProductIds = Favorite::where('user_id', Auth::id())->pluck('product_id')->toArray();
            } else {
                $favoriteProductIds = Favorite::where('session_id', Session::getId())->pluck('product_id')->toArray();
            }
            $view->with('favoriteProductIds', $favoriteProductIds);
        });
    }
}
