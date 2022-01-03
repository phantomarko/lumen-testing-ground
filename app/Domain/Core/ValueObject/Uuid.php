<?php

namespace App\Domain\Core\ValueObject;

final class Uuid extends StringValueObject
{
    protected const VALUE_OBJECT_NAME = 'Uuid';
    private const MIN_LENGTH = 20;
    private const MAX_LENGTH = 40;

    protected function validate(?string $value): void
    {
        $this->isNotEmpty($value);
        $this->lengthIsInTheRange($value, self::MIN_LENGTH, self::MAX_LENGTH);
    }
}
