<?php

namespace App\Domain\Product\Builder;

use App\Domain\Core\Exception\ValueIsEmptyException;
use App\Domain\Core\Service\UuidGenerator;
use App\Domain\Core\ValueObject\Price;
use App\Domain\Core\ValueObject\Uuid;
use App\Domain\Product\Exception\ProductNotFoundException;
use App\Domain\Product\Model\Product;
use App\Domain\Product\Repository\ProductRepository;
use App\Domain\Product\ValueObject\ProductName;

class ProductUpdater
{
    private const UUID = 'uuid';
    private const NAME = 'name';
    private const PRICE = 'price';
    private const REQUIRED_FIELDS = [
        self::UUID,
    ];
    private ?array $properties;

    public function __construct(private ProductRepository $productRepository)
    {
        $this->reset();
    }

    public function update(): Product
    {
        $this->areTheRequiredPropertiesInstantiated();

        if(null === $product = $this->productRepository->findByUuid($this->properties[self::UUID])){
            throw new ProductNotFoundException($this->properties[self::UUID]);
        }

        $product->update($this->properties[self::NAME], $this->properties[self::PRICE]);

        $this->reset();

        return $product;
    }

    public function addUuid(?string $uuid): self
    {
        $this->properties[self::UUID] = null === $uuid ? null : new Uuid($uuid);

        return $this;
    }

    public function addName(?string $name): self
    {
        $this->properties[self::NAME] = null === $name ? null : new ProductName($name);

        return $this;
    }

    public function addPrice(?float $amount, ?string $currency): self
    {
        $this->properties[self::PRICE] = (null === $amount && null === $currency ) ? null : new Price($amount, $currency);

        return $this;
    }

    private function areTheRequiredPropertiesInstantiated(): void
    {
        foreach ($this->properties as $property => $value) {
            if ($this->isRequiredProperty($property) && is_null($value)) {
                throw new ValueIsEmptyException($property);
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
            self::UUID  => null,
            self::NAME  => null,
            self::PRICE => null,
        ];
    }
}
