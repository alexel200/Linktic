<?php

namespace Src\products\application;

use Src\products\domain\contracts\ProductRepositoryInterface;
use Src\products\domain\entity\Product;
use Src\products\domain\value_objects\ProductName;
use Src\products\domain\value_objects\ProductPrice;
use Src\products\domain\value_objects\ProductStock;

class UpdateProductUseCase
{
    public function __construct(private ProductRepositoryInterface $product_repository)
    {

    }

    public function execute(int $product_id, array $new_product){
        $old_product = $this->product_repository->getProductById($product_id);

        if($old_product){
            $product_name = new ProductName($new_product['name']);
            $product_price = new ProductPrice($new_product['price']);
            $product_stock = new ProductStock($new_product['stock']);
            $description = $new_product['description'] ?? null;

            $new_product = new Product($product_name, $description, $product_price, $product_stock, $old_product->getId());
            $this->product_repository->updateProduct($new_product);
        }

        //TODO: throw error, product doesnt exist
    }

}
