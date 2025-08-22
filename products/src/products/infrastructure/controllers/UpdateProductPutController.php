<?php

namespace Src\products\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\products\application\UpdateProductUseCase;
use Src\products\domain\exceptions\DomainException;
use Src\products\infrastructure\http\responses\JsonApiResponse;
use Src\products\infrastructure\repositories\EloquentProductRepository;
use Src\products\infrastructure\Validator;
use Src\products\infrastructure\validators\CreateProductRequestValidator;

class UpdateProductPutController extends Controller
{
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
