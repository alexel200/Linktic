<?php

namespace Src\products\application\jsons;

use JsonSerializable;
use Src\products\domain\entity\Product;

class ProductResponse implements \JsonSerializable
{
    private Product $product;
    public function __construct(Product $product){
        $this->product = $product;
    }
    public function jsonSerialize(): string
    {
        return json_encode([
            'id' =>   $this->product->getId(),
            'name' =>   $this->product->getName()->value(),
            'description' =>   $this->product->getDescription(),
            'price' =>   $this->product->getPrice()->value(),
            'stock' =>   $this->product->getStock()->value(),
        ]);
    }
}
