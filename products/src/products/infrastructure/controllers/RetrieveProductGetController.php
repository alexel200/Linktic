<?php

namespace Src\products\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Src\products\application\jsons\ProductResponse;
use Src\products\application\RetrieveProductUseCase;
use Src\products\infrastructure\http\responses\JsonApiResponse;
use Src\products\infrastructure\repositories\EloquentProductRepository;

class RetrieveProductGetController extends Controller
{
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
