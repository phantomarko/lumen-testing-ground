<?php

namespace App\Application\Product\Service;

use App\Domain\Core\ValueObject\Uuid;

class GetProductRequest
{
    private Uuid $uuid;

    public function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }
}
