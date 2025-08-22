<?php

namespace Src\inventory\application;

use Illuminate\Http\JsonResponse;
use Src\inventory\domain\contracts\InventoryRepositoryInterface;
use Src\inventory\domain\exceptions\BadRequestException;
use Src\inventory\domain\exceptions\DomainException;
use Src\inventory\domain\exceptions\InsufficientStockException;
use Src\inventory\infrastructure\http\clients\ProductByIdClient;
use Src\inventory\infrastructure\http\responses\JsonApiResponse;


readonly class AddProductToInventoryUseCase
{
    public function __construct(private InventoryRepositoryInterface $inventory_repository)
    {
    }

    public function execute(int $product_id, int $quantity):JsonResponse{
        try {
            $product_client = new ProductByIdClient();
            $product = $product_client->getProductById($product_id);

            if($quantity < 0){
                throw new BadRequestException("No puede agregar productos con stock negativo");
            }

            if($product->stock < $quantity){
                throw new InsufficientStockException();
            }

            $this->inventory_repository->addProductToInventory($product_id, $quantity);

            return JsonApiResponse::success([]);
        }catch(DomainException|\Exception $exception){
            return JsonApiResponse::error($exception->getMessage(), $exception->getCode() ?? 500);
        }
    }

}
