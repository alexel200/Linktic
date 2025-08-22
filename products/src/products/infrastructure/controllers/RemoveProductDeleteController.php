<?php

namespace Src\products\infrastructure\controllers;

use Illuminate\Routing\Controller;
use Src\products\application\RemoveProductUseCase;
use Src\products\domain\exceptions\DomainException;
use Src\products\infrastructure\http\responses\JsonApiResponse;
use Src\products\infrastructure\repositories\EloquentProductRepository;

class RemoveProductDeleteController extends Controller
{
    /**
     * @OA\Delete(
     *     path="/api/products/{product_id}",
     *     summary="Eliminar un producto",
     *     description="Elimina un producto existente por su ID.",
     *     operationId="removeProduct",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         name="product_id",
     *         in="path",
     *         description="ID del producto a eliminar",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto eliminado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items())
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error de dominio o validación",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="Producto no encontrado"),
     *             @OA\Property(property="code", type="integer", example=400)
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="Error inesperado al eliminar el producto"),
     *             @OA\Property(property="code", type="integer", example=500)
     *         )
     *     )
     * )
     */

    public function index(int $product_id = 0)
    {
        try{
            if($product_id > 0){
                $remove_product = new RemoveProductUseCase(new EloquentProductRepository());
                $remove_product->execute($product_id);
            }
            return JsonApiResponse::success([]);
        }catch (DomainException $e){
            return JsonApiResponse::error($e->getMessage(), $e->getCode());
        }catch(\Exception $e){
            return JsonApiResponse::error($e->getMessage(), 500);
        }

    }
}
