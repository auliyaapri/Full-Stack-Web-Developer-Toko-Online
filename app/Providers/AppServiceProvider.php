<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    // public function boot(): void
    // {
    //     //
    // }


    public function boot(\Illuminate\Http\Request $request)
    {
        if (!empty(env('https://64e9-2400-9800-6032-6189-bcaa-b0bd-5beb-c601.ngrok-free.app')) && $request->server->has('HTTP_X_ORIGINAL_HOST')) {
            $this->app['url']->forceRootUrl(env('https://64e9-2400-9800-6032-6189-bcaa-b0bd-5beb-c601.ngrok-free.app'));
        }

        // other code

    }
}
