<?php

namespace App\Infrastructure\Core\ValueObject\EntityManager;

use App\Domain\Core\ValueObject\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class UuidCustomType extends StringType
{
    private const NAME = 'uuid';

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $value = parent::convertToPHPValue($value, $platform);

        return new Uuid($value);
    }

    /**
     * @param Uuid $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getValue();
    }

    public function getName()
    {
        return self::NAME;
    }
}
