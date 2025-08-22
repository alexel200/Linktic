<?php

namespace Src\inventory\infrastructure\controllers;


use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Src\inventory\application\AddProductStockUseCase;
use Src\inventory\infrastructure\repositories\EloquentInventoryRepository;

class AddProductStockPatchController extends Controller
{
    /**
     * @OA\Patch(
     *     path="/api/inventory/add-stock/{product_id}",
     *     summary="Agregar stock a un producto",
     *     description="Agrega una cantidad específica de stock a un producto existente en el inventario.",
     *     operationId="addProductStock",
     *     tags={"Inventory"},
     *     @OA\Parameter(
     *         name="product_id",
     *         in="path",
     *         required=true,
     *         description="ID del producto al que se le agregará stock",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"quantity"},
     *             @OA\Property(property="quantity", type="integer", example=20)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Stock agregado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Stock agregado correctamente.")
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


    public function index(int $product_id, Request $request): JsonResponse{
        $data = $request->all();

        $add_product = new AddProductStockUseCase(new EloquentInventoryRepository());
        return $add_product->execute($product_id, $data['quantity']);
    }
}
