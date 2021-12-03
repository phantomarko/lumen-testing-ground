<?php

namespace App\Domain\Product\Exception;

class RequiredProductParameterIsNullException extends \Exception
{
    public function __construct(string $parameterName)
    {
        parent::__construct('The required parameter \'' . $parameterName . '\' is null');
    }
}
