<?php

namespace App\Domain\Product\Builder;

use App\Domain\Core\Service\UuidGeneratorInterface;
use App\Domain\Core\ValueObject\Currency;
use App\Domain\Core\ValueObject\Price;
use App\Domain\Product\Exception\RequiredProductParameterIsNullException;
use App\Domain\Product\Model\Product;
use App\Domain\Product\ValueObject\ProductName;

class ProductBuilder
{
    private const UUID = 'uuid';
    private const NAME = 'name';
    private const PRICE = 'price';
    private const REQUIRED_FIELDS = [
        self::UUID,
        self::NAME,
        self::PRICE
    ];

    private UuidGeneratorInterface $uuidGenerator;
    private ?array $properties;

    public function __construct(UuidGeneratorInterface $uuidGenerator)
    {
        $this->uuidGenerator = $uuidGenerator;
        $this->reset();
    }

    public function build(): Product
    {
        $this->areTheRequiredPropertiesInstantiated();
        $product = new Product(
            $this->properties[self::UUID],
            $this->properties[self::NAME],
            $this->properties[self::PRICE]
        );
        $this->reset();

        return $product;
    }

    public function generateUuid(): self
    {
        $this->properties [self::UUID] = $this->uuidGenerator->generate();

        return $this;
    }

    public function addName(?string $name): self
    {
        if (!is_null($name)) {
            $this->properties[self::NAME] = new ProductName($name);
        }

        return $this;
    }

    public function addPrice(?float $amount, ?string $currency): self
    {
        if (!is_null($amount) && !is_null($currency)) {
            $this->properties[self::PRICE] = new Price($amount, new Currency($currency));
        }

        return $this;
    }

    private function areTheRequiredPropertiesInstantiated(): void
    {
        foreach ($this->properties as $property => $value) {
            if ($this->isRequiredProperty($property) && is_null($value)) {
                throw new RequiredProductParameterIsNullException($property);
            }
        }
    }

    private function isRequiredProperty(string $propertyKey): bool
    {
        return in_array($propertyKey, self::REQUIRED_FIELDS);
    }

    private function reset(): void
    {
        $this->properties = [
            self::NAME => null,
            self::PRICE => null,
        ];
    }
}