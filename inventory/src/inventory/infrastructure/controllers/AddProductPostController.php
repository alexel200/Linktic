<?php

namespace Src\inventory\infrastructure\controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Src\inventory\application\AddProductToInventoryUseCase;
use Src\inventory\domain\exceptions\DomainException;
use Src\inventory\infrastructure\http\responses\JsonApiResponse;
use Src\inventory\infrastructure\repositories\EloquentInventoryRepository;

class AddProductPostController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/inventory/add",
     *     summary="Agregar producto al inventario",
     *     description="Agrega una cantidad específica de un producto al inventario.",
     *     operationId="addProductToInventory",
     *     tags={"Inventory"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"product_id", "quantity"},
     *             @OA\Property(property="product_id", type="integer", example=1),
     *             @OA\Property(property="quantity", type="integer", example=10)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto agregado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Producto agregado al inventario.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error de validación o datos incorrectos",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Datos inválidos.")
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

    public function index(Request $request):JsonResponse
    {
        try {
            $data = $request->all();
            $add_product = new AddProductToInventoryUseCase(new EloquentInventoryRepository());
            return $add_product->execute($data['product_id'], $data['quantity']);
        }catch(DomainException|\Exception $exception){

            $httpCode = $exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                ? $exception->getStatusCode()
                : 500;


            return JsonApiResponse::error($exception->getMessage(), $httpCode);
        }
    }
}
