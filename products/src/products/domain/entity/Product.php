<?php

namespace Src\products\domain\entity;

use Src\products\domain\value_objects\ProductName;
use Src\products\domain\value_objects\ProductPrice;
use Src\products\domain\value_objects\ProductStock;

class Product
{
    private int $id;
    private ProductName $name;
    private ProductPrice $price;
    private string $description = "";
    private ProductStock $stock;
    public function __construct(
        ProductName $name,
        string $description,
        ProductPrice $price,
        ProductStock $stock,
        int $id = null
    ) {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->stock = $stock;
        if($id != null){
            $this->id = $id;
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ProductName
    {
        return $this->name;
    }

    public function getPrice(): ProductPrice
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStock(): ProductStock
    {
        return $this->stock;
    }
}
