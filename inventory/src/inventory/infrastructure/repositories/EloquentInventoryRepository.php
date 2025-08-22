<?php

namespace Src\inventory\infrastructure\repositories;

use Src\inventory\domain\contracts\InventoryRepositoryInterface;
use Src\inventory\domain\entity\Inventory;
use App\Models\Inventory as EloquentInventory;
use Src\inventory\domain\exceptions\BadRequestException;
use Src\inventory\infrastructure\mappers\InventoryMapper;

class EloquentInventoryRepository implements InventoryRepositoryInterface
{

    public function getInventory(): array
    {
        return EloquentInventory::all()->map(function (EloquentInventory $inventory) {
            return InventoryMapper::fromEloquent($inventory);
        });
    }

    public function getInventoryById(int $product_id): ?Inventory
    {
        $eloquent_inventory = EloquentInventory::where('product_id', $product_id)->first();
        if (!$eloquent_inventory) {
            return null;
        }
        return InventoryMapper::fromEloquent($eloquent_inventory);
    }

    public function incrementStock(int $product_id, int $quantity): void
    {
        EloquentInventory::where('product_id', $product_id)->increment('quantity', $quantity);

    }

    public function decrementStock(int $product_id, int $quantity): void
    {
        EloquentInventory::where('product_id', $product_id)->decrement('quantity', $quantity);

    }

    public function addProductToInventory(int $product_id, int $quantity): void
    {
        $eloquent_inventory = $this->getInventoryById($product_id);

        if($eloquent_inventory){
            throw new BadRequestException("El producto ya existe en el inventario, por favor intente actualizarlo en lugar de adicionar.");
        }

        EloquentInventory::create(['product_id' => $product_id, 'quantity' => $quantity]);
    }
}
