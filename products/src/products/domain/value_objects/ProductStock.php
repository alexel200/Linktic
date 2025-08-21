<?php

namespace Src\products\domain\value_objects;

class ProductStock
{
    private int $product_stock;
    public function __construct(int $product_stock){
        if ($product_stock < 0) {
            $product_stock = 0;
        }
        $this->product_stock = $product_stock;
    }
    public function value(): int
    {
        return $this->product_stock;
    }
}
