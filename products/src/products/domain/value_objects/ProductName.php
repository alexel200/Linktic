<?php

namespace Src\products\domain\value_objects;

final class ProductName
{
    private string $name;
    public function __construct(string $name)
    {
        if(empty($name) || strlen($name) < 3)
        {
            throw new \InvalidArgumentException("El nombre del producto no puede contener al menos 3 caracteres");
        }
        $this->name = $name;
    }

    public function value(): string
    {
        return $this->name;
    }
}
