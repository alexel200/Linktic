<?php

namespace Tests\Unit\products\domain\value_objects;

use PHPUnit\Framework\TestCase;
use Src\products\domain\value_objects\ProductStock;

class ProductStockTest extends TestCase
{
    public function test_valid_product_stock()
    {
        $stock = 15;
        $productStock = new ProductStock($stock);

        $this->assertEquals($stock, $productStock->value());
    }

    public function test_negative_product_stock_is_set_to_zero()
    {
        $stock = -10;
        $productStock = new ProductStock($stock);

        $this->assertEquals(0, $productStock->value());
    }

    public function test_zero_product_stock()
    {
        $stock = 0;
        $productStock = new ProductStock($stock);

        $this->assertEquals(0, $productStock->value());
    }
}
