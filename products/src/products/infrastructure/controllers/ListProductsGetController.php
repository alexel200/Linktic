<?php

namespace Src\products\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\products\application\jsons\ListProductsResponse;
use Src\products\application\ListProductsUseCase;
use Src\products\infrastructure\repositories\EloquentProductRepository;

class ListProductsGetController extends Controller
{
    public function index():array{
        $list_products = new ListProductsUseCase(new EloquentProductRepository());
        $products = $list_products->execute();
        return array_map(fn($product) => new ListProductsResponse($product), $products);
    }
}
