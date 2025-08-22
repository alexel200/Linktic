<?php

namespace Tests\Unit\products\domain\value_objects;

use PHPUnit\Framework\TestCase;
use Src\products\domain\value_objects\ProductPrice;

class ProductPriceTest extends TestCase
{
    public function test_valid_product_price()
    {
        $price = 99.99;
        $productPrice = new ProductPrice($price);

        $this->assertEquals($price, $productPrice->value());
    }

    public function test_negative_product_price_is_set_to_zero()
    {
        $price = -50.00;
        $productPrice = new ProductPrice($price);

        $this->assertEquals(0.0, $productPrice->value());
    }

    public function test_zero_product_price()
    {
        $price = 0.0;
        $productPrice = new ProductPrice($price);

        $this->assertEquals(0.0, $productPrice->value());
    }
}
