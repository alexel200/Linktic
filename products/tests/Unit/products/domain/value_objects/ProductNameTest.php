<?php

namespace Tests\Unit\products\domain\value_objects;

use PHPUnit\Framework\TestCase;
use Src\products\domain\value_objects\ProductName;
use Src\products\domain\exceptions\BadRequestException;

class ProductNameTest extends TestCase
{
    public function test_valid_product_name()
    {
        $name = 'Laptop';
        $productName = new ProductName($name);

        $this->assertEquals($name, $productName->value());
    }

    public function test_empty_product_name_throws_exception()
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage("El nombre del producto debe contener al menos 3 caracteres");

        new ProductName('');
    }

    public function test_short_product_name_throws_exception()
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage("El nombre del producto debe contener al menos 3 caracteres");

        new ProductName('TV');
    }
}
