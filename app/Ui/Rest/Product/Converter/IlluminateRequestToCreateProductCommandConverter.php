<?php

namespace App\Ui\Rest\Product\Converter;

use App\Application\Product\Command\CreateProductCommand;
use Illuminate\Http\Request;

class IlluminateRequestToCreateProductCommandConverter
{
    private const NAME = 'name';
    private const PRICE = 'priceAmount';
    private const CURRENCY = 'priceCurrency';

    public function convert(Request $request): CreateProductCommand
    {
        $contentArray = $request->toArray();

        return new CreateProductCommand(
            $contentArray[self::NAME] ?? null,
            $contentArray[self::PRICE] ?? null,
            $contentArray[self::CURRENCY] ?? null
        );
    }
}
