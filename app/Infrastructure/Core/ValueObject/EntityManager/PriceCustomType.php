<?php

namespace App\Infrastructure\Core\ValueObject\EntityManager;

use App\Domain\Core\ValueObject\Currency;
use App\Domain\Core\ValueObject\Price;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class PriceCustomType extends StringType
{
    private const NAME = 'price';

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $value = parent::convertToPHPValue($value, $platform);

        $value = explode('|', $value);
        return new Price(
            $value[0],
            new Currency($value[1])
        );
    }

    /**
     * @param Price $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return implode(
            '|',
            [
                $value->getAmount(),
                $value->getCurrency()
            ]
        );
    }

    public function getName()
    {
        return self::NAME;
    }
}
