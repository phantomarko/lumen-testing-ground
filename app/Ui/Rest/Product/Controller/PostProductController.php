<?php

namespace App\Ui\Rest\Product\Controller;

use App\Domain\Core\ValueObject\Uuid;
use App\Infrastructure\Core\Bus\CommandBus;
use App\Ui\Rest\Core\Controller\BaseController;
use App\Ui\Rest\Core\Response\BaseResponse;
use App\Ui\Rest\Product\Converter\IlluminateRequestToCreateProductCommandConverter;
use Illuminate\Http\Request;

class PostProductController extends BaseController
{
    private CommandBus $commandBus;
    private IlluminateRequestToCreateProductCommandConverter $requestToCommandConverter;

    public function __construct(
        CommandBus $commandBus,
        IlluminateRequestToCreateProductCommandConverter $requestToCommandConverter
    ) {
        $this->commandBus = $commandBus;
        $this->requestToCommandConverter = $requestToCommandConverter;
    }

    public function index(Request $request): BaseResponse
    {
        /** @var Uuid $uuid */
        $uuid = $this->commandBus->handle($this->requestToCommandConverter->convert($request));

        return $this->createResourceCreatedResponse($uuid);
    }
}
