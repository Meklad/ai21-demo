<?php

namespace App\Providers;

use App\Services\Ai21\Ai21Service;
use App\Services\Chat\ChatService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ChatService::class, function ($app) {
            return new ChatService(new Ai21Service);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
