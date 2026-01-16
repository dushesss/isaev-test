<?php

namespace App\Repositories;

use App\Models\Product;
use App\Services\ProductFilterService;
use App\Services\ProductSortService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private readonly ProductFilterService $filterService,
        private readonly ProductSortService $sortService
    ) {
    }

    /**
     * Получить товары с фильтрацией, сортировкой и пагинацией
     */
    public function getFilteredProducts(array $filters): LengthAwarePaginator
    {
        $query = Product::query()->with('category');

        // Применяем фильтры
        $query = $this->filterService->applyFilters($query, $filters);

        // Применяем сортировку
        $query = $this->sortService->applySort($query, $filters['sort'] ?? 'newest');

        // Применяем пагинацию
        $perPage = $filters['per_page'] ?? 15;

        return $query->paginate($perPage);
    }
}
