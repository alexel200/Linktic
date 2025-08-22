<?php

namespace Src\products\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Src\products\application\CreateProductUseCase;
use Src\products\domain\exceptions\DomainException;
use Src\products\infrastructure\http\responses\JsonApiResponse;
use Src\products\infrastructure\repositories\EloquentProductRepository;
use Src\products\infrastructure\Validator;
use Src\products\infrastructure\validators\CreateProductRequestValidator;

class CreateProductPostController extends Controller
{
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
