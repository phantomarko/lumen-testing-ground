<?php

namespace App\Domain\Core\Service;

use App\Domain\Core\ValueObject\Uuid;

interface UuidGenerator
{
    public function generate(): Uuid;
}
