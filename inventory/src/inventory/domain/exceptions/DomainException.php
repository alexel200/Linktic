<?php

namespace Src\inventory\domain\exceptions;

use Exception;

abstract class DomainException extends Exception
{
    abstract public function getStatusCode(): int;
}
