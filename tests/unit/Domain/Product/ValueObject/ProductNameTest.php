<?php

namespace unit\Domain\Product\ValueObject;

use App\Domain\Core\Exception\ValueHasAnInvalidLengthException;
use App\Domain\Core\Exception\ValueIsEmptyException;
use App\Domain\Product\ValueObject\ProductName;
use PHPUnit\Framework\TestCase;

class ProductNameTest extends TestCase
{

    public function testCreate_empty_product_name()
    {
        $this->expectException(ValueIsEmptyException::class);

        new ProductName(null);
    }

    /**
     * @dataProvider create_invalid_length_product_nameProvider
     */
    public function testCreate_invalid_length_product_name(string $value)
    {
        $this->expectException(ValueHasAnInvalidLengthException::class);

        new ProductName($value);
    }

    /**
     * @dataProvider create_product_successfullyProvider
     */
    public function testCreate_product_successfully(string $value)
    {
        $productName = new ProductName($value);

        $this->assertEquals($value, $productName->getValue());
    }

    public function create_invalid_length_product_nameProvider(): array
    {
        return [
            'less than 3' => ['ab'],
            'greater than 30' => ['1234567890123456789012345678901'],
        ];
    }

    public function create_product_successfullyProvider(): array
    {
        return [
            'equal 3' => ['abc'],
            'greater than 3' => ['abcd'],
            'less than 30' => ['12345678901234567890123456789'],
            'equal 30' => ['123456789012345678901234567890'],
        ];
    }
}
