<?php

namespace Src\products\infrastructure\controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Src\products\application\CreateProductUseCase;
use Src\products\domain\exceptions\DomainException;
use Src\products\infrastructure\http\responses\JsonApiResponse;
use Src\products\infrastructure\repositories\EloquentProductRepository;
use Src\products\infrastructure\Validator;
use Src\products\infrastructure\validators\CreateProductRequestValidator;

class CreateProductPostController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/products/create",
     *     summary="Crear un nuevo producto",
     *     description="Crea un producto con nombre, descripción, precio y stock.",
     *     operationId="createProduct",
     *     tags={"Productos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "description", "price", "stock"},
     *             @OA\Property(property="name", type="string", example="Laptop Dell XPS 13"),
     *             @OA\Property(property="description", type="string", example="Ultrabook con pantalla táctil y procesador Intel i7"),
     *             @OA\Property(property="price", type="number", format="float", example=1299.99),
     *             @OA\Property(property="stock", type="integer", example=50)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto creado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items())
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error de validación o dominio",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="El nombre del producto es obligatorio"),
     *             @OA\Property(property="code", type="integer", example=400)
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="Error inesperado al crear el producto"),
     *             @OA\Property(property="code", type="integer", example=500)
     *         )
     *     )
     * )
     */

    public function index(Request $request): JsonResponse
    {
        try {
            $validator = new Validator(CreateProductRequestValidator::getConfig());
            $validator->validate($request);

            $data = $request->all();

            $create_product = new CreateProductUseCase(new EloquentProductRepository());
            $create_product->execute($data['name'], $data['description'], $data['price'], $data['stock']);
            return JsonApiResponse::success([]);
        }catch(DomainException $e){
            return JsonApiResponse::error($e->getMessage(), $e->getCode());
        }catch(\Exception $e){
            return JsonApiResponse::error($e->getMessage(), 500);
        }
    }

}
