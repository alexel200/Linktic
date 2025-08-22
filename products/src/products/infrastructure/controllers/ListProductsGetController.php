<?php

namespace Src\products\infrastructure\controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\products\application\jsons\ListProductsResponse;
use Src\products\application\ListProductsUseCase;
use Src\products\infrastructure\http\responses\JsonApiResponse;
use Src\products\infrastructure\repositories\EloquentProductRepository;

class ListProductsGetController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $page = $request->query('page');
        $perPage = $request->query('per_page');

        $list_products = new ListProductsUseCase(new EloquentProductRepository());
        $result = $list_products->execute($page ? (int)$page : null, $perPage ? (int)$perPage : null);

        return JsonApiResponse::success($result);
    }
}

