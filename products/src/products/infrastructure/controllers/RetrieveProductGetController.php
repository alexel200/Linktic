<?php

namespace Src\products\infrastructure\controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Src\products\application\jsons\ProductResponse;
use Src\products\application\RetrieveProductUseCase;
use Src\products\infrastructure\http\responses\JsonApiResponse;
use Src\products\infrastructure\repositories\EloquentProductRepository;

class RetrieveProductGetController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products/{product_id}",
     *     summary="Obtener detalles de un producto",
     *     description="Recupera la información de un producto específico por su ID.",
     *     operationId="retrieveProduct",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         name="product_id",
     *         in="path",
     *         description="ID del producto a consultar",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto encontrado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Laptop Dell XPS 13"),
     *                 @OA\Property(property="description", type="string", example="Ultrabook con pantalla táctil"),
     *                 @OA\Property(property="price", type="number", format="float", example=1299.99),
     *                 @OA\Property(property="stock", type="integer", example=50)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="ID inválido o producto no encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="Por favor revise el id del producto"),
     *             @OA\Property(property="code", type="integer", example=400)
     *         )
     *     )
     * )
     */

    public function index($product_id = 0):JsonResponse{
        if($product_id > 0){
            $retrieve_product = new RetrieveProductUseCase(new EloquentProductRepository());
            $product_domain = $retrieve_product->execute($product_id);
            $response = array_map(fn($product) => new ProductResponse($product), [$product_domain]);
            return JsonApiResponse::success($response[0]);
        }
        return JsonApiResponse::error("Por favor revise el id del producto", 400);
    }
}
