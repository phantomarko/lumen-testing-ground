<?php

namespace App\Infrastructure\Product\Controller\Http;

use App\Domain\Core\ValueObject\Uuid;
use App\Infrastructure\Core\Controller\Http\BaseController;
use App\Infrastructure\Core\Controller\Http\BaseResponse;
use App\Infrastructure\Product\Converter\IlluminateRequestToCreateProductCommandConverter;
use Illuminate\Http\Request;
use League\Tactician\CommandBus;

class PostProductController extends BaseController
{
    private CommandBus $commandBus;
    private IlluminateRequestToCreateProductCommandConverter $requestToCommandConverter;

    public function __construct(
        CommandBus $commandBus,
        IlluminateRequestToCreateProductCommandConverter $requestToCommandConverter
    )
    {
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
