<?php

namespace Src\inventory\domain\exceptions;

class RequestException extends DomainException
{
    protected $code;
    protected $message;
    public function __construct(string $message = "", int $code = 0)
    {
        $this->message = $message;
        $this->code = $code;
        parent::__construct($this->message, $this->code);
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }
}
