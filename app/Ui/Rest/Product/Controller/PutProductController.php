<?php

namespace App\Ui\Rest\Product\Controller;

use App\Domain\Core\ValueObject\Uuid;
use App\Infrastructure\Core\Bus\CommandBus;
use App\Ui\Rest\Core\Controller\BaseController;
use App\Ui\Rest\Core\Response\BaseResponse;
use App\Ui\Rest\Product\Converter\IlluminateRequestToCreateProductCommandConverter;
use App\Ui\Rest\Product\Converter\IlluminateRequestToUpdateProductCommandConverter;
use Illuminate\Http\Request;

class PutProductController extends BaseController
{
    private CommandBus $commandBus;
    private IlluminateRequestToUpdateProductCommandConverter $requestToCommandConverter;

    public function __construct(
        CommandBus $commandBus,
        IlluminateRequestToUpdateProductCommandConverter $requestToCommandConverter
    ) {
        $this->commandBus = $commandBus;
        $this->requestToCommandConverter = $requestToCommandConverter;
    }

    public function update(Request $request): BaseResponse
    {
        /** @var \App\Domain\Product\Model\Product $product */
        $product = $this->commandBus->handle($this->requestToCommandConverter->convert($request));

        return $this->createResourceUpdatedResponse($product);
    }
}
