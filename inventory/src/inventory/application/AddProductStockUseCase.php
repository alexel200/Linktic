<?php

namespace Src\inventory\application;

use Illuminate\Http\JsonResponse;
use Src\inventory\domain\contracts\InventoryRepositoryInterface;
use Src\inventory\domain\exceptions\DomainException;
use Src\inventory\infrastructure\http\clients\ProductByIdClient;
use Src\inventory\infrastructure\http\responses\JsonApiResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

readonly class AddProductStockUseCase
{
    public function __construct(private InventoryRepositoryInterface $inventory_repository)
    {

    }

    public function execute(int $product_id, int $quantity): JsonResponse
    {
        try {
            if ($quantity <= 0) {
                throw new BadRequestHttpException("Para aumentar el stock de productos, debe suministrar valores superiores a cero");
            }

            $product_client = new ProductByIdClient();
            $product = $product_client->getProductById($product_id);
            if (!$product) {
                throw new BadRequestHttpException("Producto no encontrado");
            }

            $this->inventory_repository->incrementStock($product_id, $quantity);
            return JsonApiResponse::success(['msg' => "stock actualizado correctamente"]);
        }catch(DomainException|\Exception $exception){
            return JsonApiResponse::error($exception->getMessage(), $exception->getCode());
        }

    }
}
