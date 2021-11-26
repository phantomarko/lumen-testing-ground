<?php

namespace App\Domain\Core\ValueObject;

abstract class StringValueObject
{
    private string $value;

    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * Throws an exception if the value is not valid
     * @param string $value
     */
    abstract protected function validate(string $value): void;

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->getValue();
    }
}
