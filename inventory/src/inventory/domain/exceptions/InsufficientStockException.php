<?php

namespace Src\inventory\domain\exceptions;

class InsufficientStockException extends DomainException
{
    protected $message;
    protected $code;

    public function __construct($message = "El producto no tiene suficiente stock", $code = 403)
    {
        $this->message = $message;
        $this->code = $code;
        parent::__construct($message, $code);
    }

    public function getStatusCode(): int
    {
        return 403;
    }
}
