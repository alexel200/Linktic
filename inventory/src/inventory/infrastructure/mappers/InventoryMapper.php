<?php

namespace Src\inventory\infrastructure\mappers;
use App\Models\Inventory as EloquentInventory;
use Src\inventory\domain\entity\Inventory;

class InventoryMapper
{
    public static function fromEloquent(EloquentInventory $eloquent): Inventory{
        return new Inventory(product_id: $eloquent['product_id'], quantity: $eloquent['quantity'], id: $eloquent['id']);
    }
}

