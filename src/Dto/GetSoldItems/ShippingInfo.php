<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetSoldItems;

use DateTimeInterface;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class ShippingInfo implements ResponseDtoInterface
{
    /**
     * @param ParcelLabel[] $parcelLabels
     */
    public function __construct(
        private ?string $shippingMethod = null,
        private ?string $shippingReturnMethod = null,
        private ?float $shippingCost = null,
        private ?float $shippingAdditionalCost = null,
        private ?float $shippingTotalCost = null,
        private ?float $shippingTaxRate = null,
        private ?DateTimeInterface $deliveryDate = null,
        private ?string $deliveryService = null,
        private array $parcelLabels = [],
    ) {
    }

    public function getDeliveryDate(): ?DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(?DateTimeInterface $deliveryDate): void
    {
        $this->deliveryDate = $deliveryDate;
    }

    public function getDeliveryService(): ?string
    {
        return $this->deliveryService;
    }

    public function setDeliveryService(?string $deliveryService): void
    {
        $this->deliveryService = $deliveryService;
    }

    /**
     * @return ParcelLabel[]
     */
    public function getParcelLabels(): array
    {
        return $this->parcelLabels;
    }

    /**
     * @param ParcelLabel[] $parcelLabels
     */
    public function setParcelLabels(array $parcelLabels): void
    {
        $this->parcelLabels = $parcelLabels;
    }

    public function getShippingAdditionalCost(): ?float
    {
        return $this->shippingAdditionalCost;
    }

    public function setShippingAdditionalCost(?float $shippingAdditionalCost): void
    {
        $this->shippingAdditionalCost = $shippingAdditionalCost;
    }

    public function getShippingCost(): ?float
    {
        return $this->shippingCost;
    }

    public function setShippingCost(?float $shippingCost): void
    {
        $this->shippingCost = $shippingCost;
    }

    public function getShippingMethod(): ?string
    {
        return $this->shippingMethod;
    }

    public function setShippingMethod(?string $shippingMethod): void
    {
        $this->shippingMethod = $shippingMethod;
    }

    public function getShippingReturnMethod(): ?string
    {
        return $this->shippingReturnMethod;
    }

    public function setShippingReturnMethod(?string $shippingReturnMethod): void
    {
        $this->shippingReturnMethod = $shippingReturnMethod;
    }

    public function getShippingTaxRate(): ?float
    {
        return $this->shippingTaxRate;
    }

    public function setShippingTaxRate(?float $shippingTaxRate): void
    {
        $this->shippingTaxRate = $shippingTaxRate;
    }

    public function getShippingTotalCost(): ?float
    {
        return $this->shippingTotalCost;
    }

    public function setShippingTotalCost(?float $shippingTotalCost): void
    {
        $this->shippingTotalCost = $shippingTotalCost;
    }
}
