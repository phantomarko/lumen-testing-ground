<?php

namespace App\Infrastructure\Core\Exception;

class RequiredFieldIsEmptyException extends \Exception
{

    public function __construct(string $fieldName)
    {
        parent::__construct('The field \'' . $fieldName . '\' is empty');
    }
}
