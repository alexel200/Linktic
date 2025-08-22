<?php

namespace Src\inventory\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\inventory\application\AddProductToInventoryUseCase;
use Src\inventory\infrastructure\repositories\EloquentInventoryRepository;

class AddProductPostController extends Controller
{
    public function index(Request $request):JsonResponse
    {
        $data = $request->all();
        $add_product = new AddProductToInventoryUseCase(new EloquentInventoryRepository());
        return $add_product->execute($data['product_id'], $data['quantity']);
    }
}
