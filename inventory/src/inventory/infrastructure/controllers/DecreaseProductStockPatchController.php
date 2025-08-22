<?php

namespace Src\inventory\infrastructure\controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Src\inventory\application\DecreaseProductStockUseCase;
use Src\inventory\infrastructure\repositories\EloquentInventoryRepository;

class DecreaseProductStockPatchController extends Controller
{
    /**
     * @OA\Patch(
     *     path="/api/inventory/decrease-stock/{product_id}",
     *     summary="Disminuir stock de un producto",
     *     description="Disminuye una cantidad específica de stock de un producto en el inventario.",
     *     operationId="decreaseProductStock",
     *     tags={"Inventory"},
     *     @OA\Parameter(
     *         name="product_id",
     *         in="path",
     *         required=true,
     *         description="ID del producto al que se le disminuirá el stock",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"quantity"},
     *             @OA\Property(property="quantity", type="integer", example=5)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Stock disminuido exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Stock disminuido correctamente.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error de validación o datos incorrectos",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Cantidad inválida.")
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

    public function index($product_id, Request $request): JsonResponse
    {
        $data = $request->all();
        $add_product = new DecreaseProductStockUseCase(new EloquentInventoryRepository());
        return $add_product->execute($product_id, $data['quantity']);
    }
}
