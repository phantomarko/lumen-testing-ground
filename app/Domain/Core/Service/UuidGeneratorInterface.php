<?php

namespace App\Domain\Core\Service;

use App\Domain\Core\ValueObject\Uuid;

interface UuidGeneratorInterface
{
    public function generate(): Uuid;
}
