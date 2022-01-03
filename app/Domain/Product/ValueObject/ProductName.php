<?php

namespace App\Domain\Product\ValueObject;

use App\Domain\Core\ValueObject\StringValueObject;

final class ProductName extends StringValueObject
{
    protected const VALUE_OBJECT_NAME = 'Product Name';

    protected function validate(?string $value): void
    {
        $this->isNotEmpty($value);
    }
}
