<?php

namespace App\Domain\Core\ValueObject;

use App\Domain\Core\Exception\ValueIsEmptyException;

abstract class StringValueObject
{
    protected const VALUE_OBJECT_NAME = 'String';
    private string $value;

    public function __construct(?string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * Throws an exception if the value is not valid
     */
    abstract protected function validate(?string $value): void;

    protected function isNotEmpty(?string $value): void
    {
        if (empty($value)) {
            throw new ValueIsEmptyException(self::VALUE_OBJECT_NAME);
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->getValue();
    }
}
