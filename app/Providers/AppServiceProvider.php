<?php

namespace App\Providers;

use App\Contracts\ViaCepContract;
use App\Services\FileService;
use App\Services\ViaCepService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('file-manager', fn ($app) => new FileService());

        // Registrando contrato de ViaCep
        $this->app->singleton(ViaCepContract::class, ViaCepService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
