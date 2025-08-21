<?php

namespace Src\products\application;

use Src\products\domain\contracts\ProductRepositoryInterface;
use Src\products\domain\entity\Product;

class RetrieveProductUseCase
{
    public function __construct(private ProductRepositoryInterface $product_repository)
    {
    }

    public function execute(int $id): ?Product
    {
        return $this->product_repository->getProductById($id);
    }
}
