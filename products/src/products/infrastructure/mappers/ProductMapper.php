<?php

namespace Src\products\infrastructure\mappers;

use Illuminate\Support\Facades\Log;
use Src\products\domain\entity\Product;
use App\Models\Product as EloquentProduct;
use Src\products\domain\value_objects\ProductName;
use Src\products\domain\value_objects\ProductPrice;
use Src\products\domain\value_objects\ProductStock;

class ProductMapper
{
    public static function fromEloquent(EloquentProduct $eloquent): Product {
        $name = new ProductName($eloquent['name']);
        $price = new ProductPrice($eloquent['price']);
        $stock = new ProductStock($eloquent['stock']);


        return new Product(
            name: $name,
            description: $eloquent['description'],
            price: $price,
            stock: $stock,
            id: $eloquent['id']
        );
    }

}
