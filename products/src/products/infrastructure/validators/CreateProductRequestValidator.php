<?php

namespace Src\products\infrastructure\validators;

final class CreateProductRequestValidator
{
    public static function getConfig(): array{
        return [ "id" => ['required' => false, 'type' => 'int'],
            "name" => ["required" => true, "type" => "string", "min_length" => 3],
            "description" => ["required" => false, "type" => "string"],
            "price" => ["required" => true, "type" => "float", "min_value" => 0],
            "stock" => ["required" => true, "type" => "int", "min_value" => 0],
        ];
    }
}
