<?php

namespace App\Domain\Core\Exception;

class ValueHasAnInvalidLengthException extends NotValidException
{

    public function __construct(string $name)
    {
        parent::__construct('The ' . $name . ' has an invalid length');
    }
}
