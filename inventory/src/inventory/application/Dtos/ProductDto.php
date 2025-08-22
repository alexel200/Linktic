<?php

namespace Src\inventory\application\Dtos;

class ProductDto
{
    public int $id;
    public string $name;
    public string $description;
    public float $price;
    public int $stock;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->stock = $data['stock'];
    }
}

