<?php

namespace Src\products\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\products\application\RemoveProductUseCase;
use Src\products\domain\exceptions\DomainException;
use Src\products\infrastructure\http\responses\JsonApiResponse;
use Src\products\infrastructure\repositories\EloquentProductRepository;

class RemoveProductDeleteController extends Controller
{
    public function index(int $product_id = 0)
    {
        try{
            if($product_id > 0){
                $remove_product = new RemoveProductUseCase(new EloquentProductRepository());
                $remove_product->execute($product_id);
            }
            return JsonApiResponse::success([]);
        }catch (DomainException $e){
            return JsonApiResponse::error($e->getMessage(), $e->getCode());
        }catch(\Exception $e){
            return JsonApiResponse::error($e->getMessage(), 500);
        }

    }
}
