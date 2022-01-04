<?php

namespace App\Domain\Core\Exception;

class PriceIsNegativeException extends NotValidException
{

    public function __construct()
    {
        parent::__construct('The price can not be negative');
    }
}
