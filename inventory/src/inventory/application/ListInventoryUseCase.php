<?php

namespace Src\inventory\application;

use Src\inventory\application\Dtos\InventoryDto;
use Src\inventory\domain\contracts\InventoryRepositoryInterface;
use Src\inventory\infrastructure\http\clients\ProductsClient;

class ListInventoryUseCase
{
    public function __construct(private InventoryRepositoryInterface $repository)
    {

    }

    public function execute(): array{

        $inventory = $this->repository->getInventory();

        $product_client = new ProductsClient();

        $productDtos = $product_client->getProducts();

        $indexedProducts = [];
        foreach ($productDtos as $productDto) {
            $indexedProducts[$productDto->id] = $productDto;
        }

        return array_map(function ($item) use ($indexedProducts) {
            $productDto = $indexedProducts[$item->getProductId()] ?? null;


            return new InventoryDto($item, $productDto);
        }, $inventory);

    }
}
