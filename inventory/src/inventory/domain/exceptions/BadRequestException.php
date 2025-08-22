<?php

namespace Src\inventory\domain\exceptions;

class BadRequestException extends DomainException
{
    protected $code;
    protected $message;
    public function __construct($message = "", $code = 400){
        $this->message = $message;
        $this->code = $code;
        parent::__construct($message, $code);
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }
}
