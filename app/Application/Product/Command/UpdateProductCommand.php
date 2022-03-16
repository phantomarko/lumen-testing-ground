<?php

    namespace App\Application\Product\Command;

    class UpdateProductCommand
    {
        public function __construct(
            private string  $uuid,
            private ?string $name,
            private ?float  $priceAmount,
            private ?string $priceCurrency
        ) {
        }

        public function getUuid(): string
        {
            return $this->uuid;
        }

        public function getName(): ?string
        {
            return $this->name;
        }

        public function getPriceAmount(): ?float
        {
            return $this->priceAmount;
        }

        public function getPriceCurrency(): ?string
        {
            return $this->priceCurrency;
        }
    }
