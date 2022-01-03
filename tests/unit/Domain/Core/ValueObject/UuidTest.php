<?php

namespace unit\Domain\Core\ValueObject;

use App\Domain\Core\Exception\ValueHasAnInvalidLengthException;
use App\Domain\Core\Exception\ValueIsEmptyException;
use App\Domain\Core\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;

class UuidTest extends TestCase
{
    public function testCreate_empty_uuid()
    {
        $this->expectException(ValueIsEmptyException::class);

        new Uuid(null);
    }

    /**
     * @dataProvider create_invalid_length_uuidProvider
     */
    public function testCreate_invalid_length_uuid(string $value)
    {
        $this->expectException(ValueHasAnInvalidLengthException::class);

        new Uuid($value);
    }

    /**
     * @dataProvider create_uuid_successfullyProvider
     */
    public function testCreate_uuid_successfully(string $value)
    {
        $uuid = new Uuid($value);

        $this->assertEquals($value, $uuid->getValue());
    }

    public function create_invalid_length_uuidProvider(): array
    {
        return [
            'less than 20' => ['1234567890123456789'],
            'greater than 40' => ['123456789012345678901234567890123456789012345678901234567890123456789012345678901'],
        ];
    }

    public function create_uuid_successfullyProvider(): array
    {
        return [
            'equal 20' => ['12345678901234567890'],
            'greater than 20' => ['123456789012345678901'],
            'ramsey uuid' => [RamseyUuid::uuid4()->toString()],
            'less than 40' => ['123456789012345678901234567890123456789'],
            'equal 40' => ['1234567890123456789012345678901234567890'],
        ];
    }
}
