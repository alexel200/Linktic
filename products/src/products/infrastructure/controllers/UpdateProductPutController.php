<?php

namespace Src\products\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\products\application\UpdateProductUseCase;
use Src\products\infrastructure\repositories\EloquentProductRepository;
use Src\products\infrastructure\Validator;
use Src\products\infrastructure\validators\CreateProductRequestValidator;

class UpdateProductPutController extends Controller
{
    public function index(int $product_id, Request $request ){
        $validator = new Validator(CreateProductRequestValidator::getConfig());
        //$validator->validate($request);

        $data = $request->all();

        $update_product_use_case = new UpdateProductUseCase(new EloquentProductRepository());
        $update_product_use_case->execute($product_id, $data);

        //TODO: Response
    }
}
