<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShippingServices;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class ShippingMethod implements ResponseDtoInterface
{
    public function __construct(
        private int $shippingMethodID,
        private string $name,
        private ?string $countryGroup = null,
        private ?string $countryGroupCountries = null,
        private ?int $level = null,
        private ?float $taxRate = null,
        private ?float $priceFrom = null,
        private ?float $priceTo = null,
        private ?float $islandAdditionalCosts = null,
        private ?float $freeShippingPriceFrom = null,
        private ?float $additionalItemCosts = null,
        private ?WeightDefinitions $weightDefinitions = null,
    ) {
    }

    public function getAdditionalItemCosts(): ?float
    {
        return $this->additionalItemCosts;
    }

    public function setAdditionalItemCosts(?float $additionalItemCosts): void
    {
        $this->additionalItemCosts = $additionalItemCosts;
    }

    public function getCountryGroup(): ?string
    {
        return $this->countryGroup;
    }

    public function setCountryGroup(?string $countryGroup): void
    {
        $this->countryGroup = $countryGroup;
    }

    public function getCountryGroupCountries(): ?string
    {
        return $this->countryGroupCountries;
    }

    public function setCountryGroupCountries(?string $countryGroupCountries): void
    {
        $this->countryGroupCountries = $countryGroupCountries;
    }

    public function getFreeShippingPriceFrom(): ?float
    {
        return $this->freeShippingPriceFrom;
    }

    public function setFreeShippingPriceFrom(?float $freeShippingPriceFrom): void
    {
        $this->freeShippingPriceFrom = $freeShippingPriceFrom;
    }

    public function getIslandAdditionalCosts(): ?float
    {
        return $this->islandAdditionalCosts;
    }

    public function setIslandAdditionalCosts(?float $islandAdditionalCosts): void
    {
        $this->islandAdditionalCosts = $islandAdditionalCosts;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): void
    {
        $this->level = $level;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPriceFrom(): ?float
    {
        return $this->priceFrom;
    }

    public function setPriceFrom(?float $priceFrom): void
    {
        $this->priceFrom = $priceFrom;
    }

    public function getPriceTo(): ?float
    {
        return $this->priceTo;
    }

    public function setPriceTo(?float $priceTo): void
    {
        $this->priceTo = $priceTo;
    }

    public function getShippingMethodID(): int
    {
        return $this->shippingMethodID;
    }

    public function setShippingMethodID(int $shippingMethodID): void
    {
        $this->shippingMethodID = $shippingMethodID;
    }

    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    public function setTaxRate(?float $taxRate): void
    {
        $this->taxRate = $taxRate;
    }

    public function getWeightDefinitions(): ?WeightDefinitions
    {
        return $this->weightDefinitions;
    }

    public function setWeightDefinitions(?WeightDefinitions $weightDefinitions): void
    {
        $this->weightDefinitions = $weightDefinitions;
    }
}
