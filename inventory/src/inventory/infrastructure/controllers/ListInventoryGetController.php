<?php

namespace Src\inventory\infrastructure\controllers;

use Illuminate\Http\JsonResponse;
use Src\inventory\application\ListInventoryUseCase;
use Src\inventory\domain\exceptions\DomainException;
use Src\inventory\infrastructure\http\responses\JsonApiResponse;
use Src\inventory\infrastructure\repositories\EloquentInventoryRepository;

class ListInventoryGetController
{
    public function index(): JsonResponse{
        $list_products = new ListInventoryUseCase(new EloquentInventoryRepository());
        try{
            $list_inventory = $list_products->execute();
            return JsonApiResponse::success($list_inventory);
        }catch(DomainException|\Exception $exception){
            return JsonApiResponse::error($exception->getMessage(), $exception->getCode());
        }

    }
}
