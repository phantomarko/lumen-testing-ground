<?php

namespace App\Infrastructure\Core\Service;

use App\Domain\Core\Service\UuidGeneratorInterface;
use App\Domain\Core\ValueObject\Uuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

class RamseyUuidGenerator implements UuidGeneratorInterface
{
    public function generate(): Uuid
    {
        return new Uuid(RamseyUuid::uuid4());
    }
}
