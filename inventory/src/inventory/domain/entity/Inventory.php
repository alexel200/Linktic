<?php

namespace Src\inventory\domain\entity;

class Inventory
{
    private int $id;
    private int $product_id;
    private int $quantity;
    public function __construct(
        int $product_id,
        int $quantity,
        ?int $id = null
    ) {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        if ($id !== null) {
            $this->id = $id;
        }
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getId(): int
    {
        return $this->id;
    }



}
