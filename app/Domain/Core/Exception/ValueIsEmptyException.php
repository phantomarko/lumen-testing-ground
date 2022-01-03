<?php

namespace App\Domain\Core\Exception;

class ValueIsEmptyException extends \Exception
{

    public function __construct(string $name)
    {
        parent::__construct('The \'' . $name . '\' must have a value');
    }
}
