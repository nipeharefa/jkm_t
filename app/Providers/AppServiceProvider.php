<?php

namespace App\Providers;


use Illuminate\Support\Facades\Auth;
use App\Service\OrderCreator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // dd(Auth::user());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // dd(Hash::make('s'));
        // dd(Auth::user());
    }
}
