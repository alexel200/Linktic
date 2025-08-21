<?php

namespace Src\products\application;

use Src\products\domain\contracts\ProductRepositoryInterface;

final readonly class ListProductsUseCase
{
    public function __construct(private ProductRepositoryInterface $product_repository)
    {
    }

    public function execute(): array
    {
        return $this->product_repository->getProducts();
    }

}
