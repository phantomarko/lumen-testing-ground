<?php

namespace App\Application\Product\Exception;

use App\Domain\Core\ValueObject\Uuid;

class ProductNotFoundException extends \Exception
{

    public function __construct(Uuid $uuid)
    {
        parent::__construct('The product with uuid "' . $uuid . '" not found');
    }
}
