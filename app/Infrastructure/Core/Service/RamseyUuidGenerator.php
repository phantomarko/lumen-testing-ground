<?php

namespace App\Infrastructure\Core\Service;

use App\Domain\Core\Service\UuidGeneratorInterface;
use App\Domain\Core\ValueObject\Uuid;

class RamseyUuidGenerator implements UuidGeneratorInterface
{
    public function generate(): Uuid
    {
        return new Uuid(\Ramsey\Uuid\Uuid::uuid4());
    }
}
