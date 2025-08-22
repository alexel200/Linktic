<?php

namespace Src\inventory\application\Dtos;

use Src\inventory\domain\entity\Inventory;

class InventoryDto
{
    public int $id;
    public int $product_id;
    public int $quantity;
    public ProductDto $product;

    public function __construct(Inventory $inventory, ProductDto $product)
    {
         $this->id = $inventory->getId();
        $this->product_id = $inventory->getProductId();
        $this->quantity = $inventory->getProductId();
        $this->product = $product;
    }
}

