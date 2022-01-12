<?php

namespace unit;

use App\Infrastructure\Core\Service\RamseyUuidGenerator;
use Ramsey\Uuid\Uuid as RamseyUuid;

trait CoreTestingTrait
{
    public function generateUuid(): string
    {
        return RamseyUuid::uuid4()->toString();
    }

    public function createRamseyUuidGenerator(): RamseyUuidGenerator
    {
        return new RamseyUuidGenerator();
    }
}
