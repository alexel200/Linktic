<?php

namespace Src\products\infrastructure\controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Src\products\application\UpdateProductUseCase;
use Src\products\domain\exceptions\DomainException;
use Src\products\infrastructure\http\responses\JsonApiResponse;
use Src\products\infrastructure\repositories\EloquentProductRepository;
use Src\products\infrastructure\Validator;
use Src\products\infrastructure\validators\CreateProductRequestValidator;

class UpdateProductPutController extends Controller
{
    /**
     * @OA\Put(
     *     path="/api/products/{product_id}",
     *     summary="Actualizar un producto",
     *     description="Actualiza los datos de un producto existente por su ID.",
     *     operationId="updateProduct",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         name="product_id",
     *         in="path",
     *         description="ID del producto a actualizar",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "description", "price", "stock"},
     *             @OA\Property(property="name", type="string", example="Laptop Dell XPS 13"),
     *             @OA\Property(property="description", type="string", example="Ultrabook actualizado con más RAM"),
     *             @OA\Property(property="price", type="number", format="float", example=1399.99),
     *             @OA\Property(property="stock", type="integer", example=45)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto actualizado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Laptop Dell XPS 13"),
     *                 @OA\Property(property="description", type="string", example="Ultrabook actualizado con más RAM"),
     *                 @OA\Property(property="price", type="number", format="float", example=1399.99),
     *                 @OA\Property(property="stock", type="integer", example=45)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error de validación o dominio",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="Datos inválidos para actualizar el producto"),
     *             @OA\Property(property="code", type="integer", example=400)
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="Error inesperado al actualizar el producto"),
     *             @OA\Property(property="code", type="integer", example=500)
     *         )
     *     )
     * )
     */

    public function index(int $product_id, Request $request ){
        try {
            $validator = new Validator(CreateProductRequestValidator::getConfig());
            $validator->validate($request);

            $data = $request->all();

            $update_product_use_case = new UpdateProductUseCase(new EloquentProductRepository());
            $new_data = $update_product_use_case->execute($product_id, $data);

            return JsonApiResponse::success($new_data);
        }catch(DomainException $e){
            return JsonApiResponse::error($e->getMessage(), $e->getCode());
        }catch(\Exception $e){
            return JsonApiResponse::error($e->getMessage(), 500);
        }
    }
}
