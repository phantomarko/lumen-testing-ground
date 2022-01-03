<?php

namespace App\Domain\Core\ValueObject;

final class Uuid extends StringValueObject
{
    protected const VALUE_OBJECT_NAME = 'Uuid';

    protected function validate(?string $value): void
    {
        $this->isNotEmpty($value);
    }
}
