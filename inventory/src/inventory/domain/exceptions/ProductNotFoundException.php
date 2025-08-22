<?php

namespace Src\inventory\domain\exceptions;

use Throwable;

class ProductNotFoundException extends DomainException
{

    public function __construct(string $message = "Producto no encontrado", int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode(): int
    {
        return 404;
    }
}
