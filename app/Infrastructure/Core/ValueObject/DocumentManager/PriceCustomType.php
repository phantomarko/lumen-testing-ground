<?php

namespace App\Infrastructure\Core\ValueObject\DocumentManager;

use App\Domain\Core\ValueObject\Currency;
use App\Domain\Core\ValueObject\Price;
use Doctrine\ODM\MongoDB\Types\ClosureToPHP;
use Doctrine\ODM\MongoDB\Types\Type;

class PriceCustomType extends Type
{
    use ClosureToPHP;

    public function convertToPHPValue($value): Price
    {
        $value = parent::convertToPHPValue($value);

        $value = explode('|', $value);
        return new Price(
            $value[0],
            new Currency($value[1])
        );
    }

    /**
     * @param Price $value
     */
    public function convertToDatabaseValue($value): string
    {
        return implode(
            '|',
            [
                $value->getAmount(),
                $value->getCurrency()->getValue()
            ]
        );
    }
}
