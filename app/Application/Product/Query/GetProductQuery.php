<?php

namespace App\Application\Product\Query;

use App\Domain\Core\ValueObject\Uuid;

class GetProductQuery
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
