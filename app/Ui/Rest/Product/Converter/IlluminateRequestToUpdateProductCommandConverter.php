<?php

namespace App\Ui\Rest\Product\Converter;

use App\Application\Product\Command\CreateProductCommand;
use App\Application\Product\Command\UpdateProductCommand;
use Illuminate\Http\Request;

class IlluminateRequestToUpdateProductCommandConverter
{
    private const UUID = 'uuid';
    private const NAME = 'name';
    private const PRICE = 'priceAmount';
    private const CURRENCY = 'priceCurrency';

    public function convert(Request $request): UpdateProductCommand
    {
        $contentArray = $request->toArray();

        return new UpdateProductCommand(
            $request->route(self::UUID),
            $contentArray[self::NAME] ?? null,
            $contentArray[self::PRICE] ?? null,
            $contentArray[self::CURRENCY] ?? null
        );
    }
}
