<?php

namespace Src\products\infrastructure\controllers;



use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Src\products\application\ListProductsUseCase;
use Src\products\infrastructure\http\responses\JsonApiResponse;
use Src\products\infrastructure\repositories\EloquentProductRepository;

class ListProductsGetController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Listar productos",
     *     description="Obtiene una lista de productos con soporte para paginación.",
     *     operationId="listProducts",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Número de página",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Cantidad de productos por página",
     *         required=false,
     *         @OA\Schema(type="integer", example=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de productos obtenida exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Laptop Dell XPS 13"),
     *                 @OA\Property(property="description", type="string", example="Ultrabook con pantalla táctil"),
     *                 @OA\Property(property="price", type="number", format="float", example=1299.99),
     *                 @OA\Property(property="stock", type="integer", example=50)
     *             ))
     *         )
     *     )
     * )
     */

    public function index(Request $request): JsonResponse
    {
        $page = $request->query('page');
        $perPage = $request->query('per_page');

        $list_products = new ListProductsUseCase(new EloquentProductRepository());
        $result = $list_products->execute($page ? (int)$page : null, $perPage ? (int)$perPage : null);

        return JsonApiResponse::success($result);
    }
}

