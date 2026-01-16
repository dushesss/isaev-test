<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductIndexRequest;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository
    ) {
    }

    /**
     * Получить список товаров с фильтрацией, сортировкой и пагинацией
     *
     * @param ProductIndexRequest $request
     * @return JsonResponse
     */
    public function index(ProductIndexRequest $request): JsonResponse
    {
        $filters = $request->getFilters();
        $products = $this->productRepository->getFilteredProducts($filters);

        return response()->json($products);
    }
}
