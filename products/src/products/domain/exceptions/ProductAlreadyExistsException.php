<?php

namespace Src\products\domain\exceptions;

class ProductAlreadyExistsException extends DomainException
{
    public function __construct(string $message = "Bad Request", int $code = 403)
    {
        parent::__construct($message, $code);
    }
}
