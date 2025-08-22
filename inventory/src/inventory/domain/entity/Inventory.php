<?php

namespace Src\inventory\domain\entity;

class Inventory
{
    private int $product_id;
    private int $quantity;
    public function __construct(
        int $product_id,
        int $quantity
    ) {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

}
