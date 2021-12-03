<?php

namespace App\Domain\Product\Exception;

use App\Domain\Core\Exception\NotFoundException;
use App\Domain\Core\ValueObject\Uuid;

class ProductNotFoundException extends NotFoundException
{

    public function __construct(Uuid $uuid)
    {
        parent::__construct('The product with uuid \'' . $uuid . '\' was not found');
    }
}
