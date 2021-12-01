<?php

namespace App\Ui\Rest\Core\Response;

use App\Domain\Core\ValueObject\Uuid;

class ResourceCreatedResponse extends BaseResponse
{
    public function __construct(Uuid $resourceUuid)
    {
        parent::__construct(['uuid' => (string)$resourceUuid], self::HTTP_CREATED);
    }

}
