<?php

namespace Src\products\domain\exceptions;

class BadRequestException extends DomainException
{
    public function __construct(string $message = "Bad Request", int $code = 400)
    {
        parent::__construct($message, $code);
    }
}
