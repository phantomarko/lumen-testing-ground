<?php

namespace App\Ui\Rest\Core\Response;

use App\Domain\Core\ValueObject\Uuid;

class ResourceCreatedResponse extends BaseResponse
{
    public function __construct(string $resourceUuid)
    {
        parent::__construct(['uuid' => $resourceUuid], self::HTTP_CREATED);
    }

}
