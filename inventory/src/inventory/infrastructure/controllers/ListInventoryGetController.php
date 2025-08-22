<?php

namespace Src\inventory\infrastructure\controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Src\inventory\application\ListInventoryUseCase;
use Src\inventory\domain\exceptions\DomainException;
use Src\inventory\infrastructure\http\responses\JsonApiResponse;
use Src\inventory\infrastructure\repositories\EloquentInventoryRepository;

class ListInventoryGetController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/inventory/list",
     *     summary="Listar inventario",
     *     description="Obtiene la lista completa de productos en el inventario.",
     *     operationId="listInventory",
     *     tags={"Inventory"},
     *     @OA\Response(
     *         response=200,
     *         description="Listado de inventario obtenido exitosamente",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="product_id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Producto A"),
     *                 @OA\Property(property="quantity", type="integer", example=100)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error inesperado.")
     *         )
     *     )
     * )
     */

    public function index(): JsonResponse{
        $list_products = new ListInventoryUseCase(new EloquentInventoryRepository());
        try{
            $list_inventory = $list_products->execute();
            return JsonApiResponse::success($list_inventory);
        }catch(DomainException|\Exception $exception){

            $httpCode = $exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                ? $exception->getStatusCode()
                : 500;


            return JsonApiResponse::error($exception->getMessage(), $httpCode);
        }
    }
}
