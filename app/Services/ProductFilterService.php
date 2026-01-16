<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class ProductFilterService
{
    /**
     * Применить фильтры к запросу
     */
    public function applyFilters(Builder $query, array $filters): Builder
    {
        // Фильтр по поиску в названии
        if (!empty($filters['q'])) {
            $query->where('name', 'LIKE', '%' . $filters['q'] . '%');
        }

        // Фильтр по цене от
        if (isset($filters['price_from'])) {
            $query->where('price', '>=', $filters['price_from']);
        }

        // Фильтр по цене до
        if (isset($filters['price_to'])) {
            $query->where('price', '<=', $filters['price_to']);
        }

        // Фильтр по категории
        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // Фильтр по наличию
        if (isset($filters['in_stock'])) {
            $query->where('in_stock', $filters['in_stock']);
        }

        // Фильтр по рейтингу от
        if (isset($filters['rating_from'])) {
            $query->where('rating', '>=', $filters['rating_from']);
        }

        return $query;
    }
}
