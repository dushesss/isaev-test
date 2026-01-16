<?php

namespace App\Providers;

use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Services\ProductFilterService;
use App\Services\ProductSortService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Регистрируем сервисы
        $this->app->singleton(ProductFilterService::class);
        $this->app->singleton(ProductSortService::class);

        // Привязываем интерфейс репозитория к реализации
        $this->app->bind(ProductRepositoryInterface::class, function ($app) {
            return new ProductRepository(
                $app->make(ProductFilterService::class),
                $app->make(ProductSortService::class)
            );
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
