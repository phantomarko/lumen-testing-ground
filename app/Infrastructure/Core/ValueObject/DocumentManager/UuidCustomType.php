<?php

namespace App\Infrastructure\Core\ValueObject\DocumentManager;

use App\Domain\Core\ValueObject\Uuid;
use Doctrine\ODM\MongoDB\Types\ClosureToPHP;
use Doctrine\ODM\MongoDB\Types\Type;

class UuidCustomType extends Type
{
    use ClosureToPHP;

    public function convertToPHPValue($value): Uuid
    {
        return new Uuid($value);
    }

    /**
     * @param Uuid|string $value
     */
    public function convertToDatabaseValue($value): string
    {
        return ($value instanceof Uuid) ? $value->getValue() : $value;
    }
}
