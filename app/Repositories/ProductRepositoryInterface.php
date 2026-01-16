<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    /**
     * Получить товары с фильтрацией, сортировкой и пагинацией
     */
    public function getFilteredProducts(array $filters): LengthAwarePaginator;
}
