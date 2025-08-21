<?php

namespace Src\products\domain\value_objects;

final class ProductPrice
{
    private float $product_price;
    public function __construct(float $product_price)
    {
        if ($product_price < 0) {
            $product_price = 0;
        }

        $this->product_price = $product_price;
    }
    public function value(): float
    {
        return $this->product_price;
    }
}
