<?php

namespace Src\inventory\domain\exceptions;

class TimeoutException extends DomainException
{
    protected $message;
    protected $code;

    public function __construct(string $message, int $code){
        $this->message = $message;
        $this->code = $code;
        parent::__construct($message, $code);
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }
}
