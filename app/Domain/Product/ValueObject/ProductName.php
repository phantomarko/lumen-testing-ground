<?php

namespace App\Domain\Product\ValueObject;

use App\Domain\Core\ValueObject\StringValueObject;

final class ProductName extends StringValueObject
{
    protected function validate(string $value): void
    {
        // TODO: Implement validate() method.
    }
}
