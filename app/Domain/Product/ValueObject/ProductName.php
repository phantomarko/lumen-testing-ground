<?php

namespace App\Domain\Product\ValueObject;

use App\Domain\Core\ValueObject\StringValueObject;

final class ProductName extends StringValueObject
{
    protected const VALUE_OBJECT_NAME = 'Product Name';
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 30;

    protected function validate(?string $value): void
    {
        $this->isNotEmpty($value);
        $this->lengthIsInTheRange($value, self::MIN_LENGTH, self::MAX_LENGTH);
    }
}
