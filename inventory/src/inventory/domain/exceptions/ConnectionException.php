<?php

namespace Src\inventory\domain\exceptions;

class ConnectionException extends DomainException
{
    protected $message;
    protected $code = 0;

    public function __construct($message = "", $code = 0){
        $this->message = $message;
        $this->code = $code;
        parent::__construct($this->message, $this->code);
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }
}
