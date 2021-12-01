<?php

namespace App\Infrastructure\Product\Converter;

use App\Application\Product\Command\CreateProductCommand;
use App\Domain\Core\ValueObject\Currency;
use App\Domain\Core\ValueObject\Price;
use App\Domain\Product\ValueObject\ProductName;
use App\Infrastructure\Core\Exception\RequiredFieldIsEmptyException;
use Illuminate\Http\Request;

class IlluminateRequestToCreateProductCommandConverter
{
    private const NAME = 'name';
    private const PRICE = 'price';
    private const CURRENCY = 'currency';
    private const REQUIRED_FIELDS = [
        self::NAME,
        self::PRICE,
        self::CURRENCY
    ];

    public function convert(Request $request): CreateProductCommand
    {
        $contentArray = $request->toArray();

        foreach (self::REQUIRED_FIELDS as $requiredField) {
            if (empty($contentArray[$requiredField])) {
                throw new RequiredFieldIsEmptyException($requiredField);
            }
        }

        return new CreateProductCommand(
            new ProductName($contentArray[self::NAME]),
            new Price($contentArray[self::PRICE], new Currency($contentArray[self::CURRENCY]))
        );
    }
}
