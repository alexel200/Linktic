<?php

namespace Src\products\application;

use Illuminate\Support\Facades\Log;
use Src\products\domain\contracts\ProductRepositoryInterface;
use Src\products\domain\entity\Product;
use Src\products\domain\value_objects\ProductName;
use Src\products\domain\value_objects\ProductPrice;
use Src\products\domain\value_objects\ProductStock;

readonly class CreateProductUseCase
{
    public function __construct(private readonly ProductRepositoryInterface $product_repository)
    {
    }
    public function execute(string $name, string $description, float $price, int $stock): void
    {
        $product_name = new ProductName($name);
        $product_price = new ProductPrice($price);
        $product_stock = new ProductStock($stock);

        $product = new Product($product_name, $description,  $product_price, $product_stock);

        try{
            $this->product_repository->createProduct($product);
        }catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
