<?php

namespace Src\inventory\infrastructure\controllers;


use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Src\inventory\application\AddProductStockUseCase;
use Src\inventory\infrastructure\repositories\EloquentInventoryRepository;

class AddProductStockPatchController
{
    public function index(int $product_id, Request $request): JsonResponse{
        $data = $request->all();

        $add_product = new AddProductStockUseCase(new EloquentInventoryRepository());
        return $add_product->execute($product_id, $data['quantity']);
    }
}
