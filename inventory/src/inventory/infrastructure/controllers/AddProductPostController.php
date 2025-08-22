<?php

namespace Src\inventory\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\inventory\application\AddProductToInventoryUseCase;
use Src\inventory\domain\exceptions\DomainException;
use Src\inventory\infrastructure\http\responses\JsonApiResponse;
use Src\inventory\infrastructure\repositories\EloquentInventoryRepository;

class AddProductPostController extends Controller
{
    public function index(Request $request):JsonResponse
    {
        try {
            $data = $request->all();
            $add_product = new AddProductToInventoryUseCase(new EloquentInventoryRepository());
            return $add_product->execute($data['product_id'], $data['quantity']);
        }catch(DomainException|\Exception $exception){

            $httpCode = $exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                ? $exception->getStatusCode()
                : 500;


            return JsonApiResponse::error($exception->getMessage(), $httpCode);
        }
    }
}
