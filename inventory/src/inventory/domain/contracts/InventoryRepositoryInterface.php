<?php

namespace Src\inventory\domain\contracts;

use Src\inventory\domain\entity\Inventory;

interface InventoryRepositoryInterface
{
    public function getInventory() : array;
    public function getInventoryById(int $product_id) : ?Inventory;
    public function incrementStock(int $product_id, int $quantity): void;
    public function decrementStock(int $product_id, int $quantity): void;
    public function addProductToInventory(int $product_id, int $quantity): void;
}
