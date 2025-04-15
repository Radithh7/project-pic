<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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
        Schema::defaultStringLength(191);
        Schema::defaultStringLength(191);
        Schema::defaultStringLength(191);
        Schema::defaultStringLength(191);
        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);
        Schema::defaultStringLength(191);
        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);
        
        Schema::defaultStringLength(191);
        
        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);
        
        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);
        
        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);
        
        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);

        Schema::defaultStringLength(191);
        
        View::composer('*', function ($view) {
            $cart = session('cart', []);
            $totalCartItems = array_sum(array_column($cart, 'quantity'));
            $view->with('totalCartItems', $totalCartItems);
        });
    }
}
