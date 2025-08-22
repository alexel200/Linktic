<?php

namespace Tests\Unit\products\application;

use PHPUnit\Framework\TestCase;
use Src\products\application\CreateProductUseCase;
use Src\products\domain\contracts\ProductRepositoryInterface;
use Src\products\domain\entity\Product;


class CreateProductUseCaseTest extends TestCase
{
    public function test_it_creates_a_product_successfully()
    {
        $mockRepository = $this->createMock(ProductRepositoryInterface::class);
        $mockRepository->expects($this->once())
            ->method('createProduct')
            ->with($this->isInstanceOf(Product::class));

        $useCase = new CreateProductUseCase($mockRepository);

        $this->expectNotToPerformAssertions();

        $useCase->execute('Test Product', 'A test description', 99.99, 10);
    }

    public function test_it_throws_generic_exception_on_other_errors()
    {
        $mockRepository = $this->createMock(ProductRepositoryInterface::class);

        $mockRepository->method('createProduct')
            ->willThrowException(new \Exception('Unexpected error'));

        $useCase = new CreateProductUseCase($mockRepository);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Unexpected error');

        $useCase->execute('Test Product', 'A test description', 99.99, 10);
    }
}
