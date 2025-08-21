<?php

namespace Src\products\domain\contracts;

use Src\products\domain\entity\Product;

interface ProductRepositoryInterface
{
    public function createProduct(Product $product): void;
    public function getProducts(): array;
    public function getProductById(int $id): ?Product;
    public function updateProduct(Product $product): void;

    public function deleteProduct(int $id): void;
}
