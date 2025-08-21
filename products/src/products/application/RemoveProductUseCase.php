<?php

namespace Src\products\application;

use Src\products\domain\contracts\ProductRepositoryInterface;
use Src\products\domain\entity\Product;

class RemoveProductUseCase
{
    public function __construct(private ProductRepositoryInterface $product_repository)
    {
    }

    public function execute(int $id): void
    {
        $this->product_repository->deleteProduct($id);
    }
}
