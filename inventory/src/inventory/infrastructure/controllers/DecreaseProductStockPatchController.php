<?php

namespace Src\inventory\infrastructure\controllers;


use Illuminate\Http\Request;
use Src\inventory\application\DecreaseProductStockUseCase;
use Src\inventory\infrastructure\repositories\EloquentInventoryRepository;

class DecreaseProductStockPatchController
{
    public function index($product_id, Request $request)
    {
        $data = $request->all();
        $add_product = new DecreaseProductStockUseCase(new EloquentInventoryRepository());
        return $add_product->execute($product_id, $data['quantity']);
    }
}
