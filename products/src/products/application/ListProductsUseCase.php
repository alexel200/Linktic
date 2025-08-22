<?php

namespace Src\products\application;

use Illuminate\Pagination\LengthAwarePaginator;
use Src\products\domain\contracts\ProductRepositoryInterface;

readonly class ListProductsUseCase
{
    public function __construct(private ProductRepositoryInterface $product_repository) {}

    public function execute(?int $page = null, ?int $perPage = null): array|LengthAwarePaginator
    {
        if ($page !== null && $perPage !== null) {
            return $this->product_repository->getPaginatedProducts($page, $perPage);
        }

        return $this->product_repository->getProducts();
    }
}
