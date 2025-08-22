<?php

namespace Src\products\domain\value_objects;

use Src\products\domain\exceptions\BadRequestException;

final class ProductName
{
    private string $name;
    public function __construct(string $name)
    {
        if(empty($name) || strlen($name) < 3)
        {
            throw new BadRequestException("El nombre del producto debe contener al menos 3 caracteres");
        }
        $this->name = $name;
    }

    public function value(): string
    {
        return $this->name;
    }
}
