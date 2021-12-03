<?php

namespace App\Domain\Core\Exception;

class CurrencyNotValidException extends \Exception
{
    public function __construct($currency)
    {
        parent::__construct('The currency \'' . $currency . '\' is not valid');
    }
}
