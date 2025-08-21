<?php


use Illuminate\Support\Facades\Route;
use Src\products\infrastructure\controllers\CreateProductPostController;
use Src\products\infrastructure\controllers\ListProductsGetController;
use Src\products\infrastructure\controllers\RemoveProductDeleteController;
use Src\products\infrastructure\controllers\RetrieveProductGetController;
use Src\products\infrastructure\controllers\UpdateProductPutController;


Route::get('/',             [ListProductsGetController::class, 'index']);
Route::get('/{product_id}', [RetrieveProductGetController::class, 'index']);
Route::post('/',            [CreateProductPostController::class, 'index']);
Route::put('/{product_id}', [UpdateProductPutController::class, 'index']);
Route::delete('/{product_id}', [RemoveProductDeleteController::class, 'index']);
