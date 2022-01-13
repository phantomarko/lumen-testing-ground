<?php

namespace App\Application\Product\Exception;

class ProductAlreadyExistsInAlternativeStorageException extends \Exception
{
    public function __construct(string $productUuid)
    {
        parent::__construct('Product \'' . $productUuid . '\' already exists in the alternative storage');
    }
}
