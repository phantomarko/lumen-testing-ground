<?php

namespace App\Infrastructure\Core\Service;

use App\Domain\Core\Service\UuidGenerator;
use App\Domain\Core\ValueObject\Uuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

class RamseyUuidGenerator implements UuidGenerator
{
    public function generate(): Uuid
    {
        return new Uuid(RamseyUuid::uuid4());
    }
}
