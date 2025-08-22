<?php


use Illuminate\Support\Facades\Route;
use Src\inventory\infrastructure\controllers\AddProductPostController;
use Src\inventory\infrastructure\controllers\AddProductStockPatchController;
use Src\inventory\infrastructure\controllers\DecreaseProductStockPatchController;


Route::post('/add-product', [AddProductPostController::class, 'index']);
Route::patch('/{product_id}/decrease-stock', [DecreaseProductStockPatchController::class, 'index']);
Route::patch('/{product_id}/increase-stock', [AddProductStockPatchController::class, 'index']);
