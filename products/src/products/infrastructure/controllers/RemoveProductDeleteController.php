<?php

namespace Src\products\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\products\application\RemoveProductUseCase;
use Src\products\infrastructure\repositories\EloquentProductRepository;

class RemoveProductDeleteController extends Controller
{
    public function index(int $product_id = 0)
    {
        if($product_id > 0){
            $remove_product = new RemoveProductUseCase(new EloquentProductRepository());
            $remove_product->execute($product_id);
        }
    }
}
