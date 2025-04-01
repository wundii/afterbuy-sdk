<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Interface\AfterbuyDtoInterface;
use DateTimeInterface;

final readonly class ShippingInfo implements AfterbuyDtoInterface
{
    /**
     * @param ParcelLabel[] $parcelLabels
     */
    public function __construct(
        private ?string $shippingMethod = null,
        private ?string $shippingReturnMethod = null,
        private ?string $shippingGroup = null,
        private ?float $shippingCost = null,
        private ?DateTimeInterface $deliveryDate = null,
        private ?string $deliveryService = null,
        private ?float $ebayShippingCost = null,
        private ?bool $sendShippingMail = null,
        private array $parcelLabels = [],
    ) {
    }

    public function getDeliveryDate(): ?DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function getDeliveryService(): ?string
    {
        return $this->deliveryService;
    }

    public function getEbayShippingCost(): ?float
    {
        return $this->ebayShippingCost;
    }

    /**
     * @return ParcelLabel[]
     */
    public function getParcelLabels(): array
    {
        return $this->parcelLabels;
    }

    public function getSendShippingMail(): ?bool
    {
        return $this->sendShippingMail;
    }

    public function getShippingCost(): ?float
    {
        return $this->shippingCost;
    }

    public function getShippingGroup(): ?string
    {
        return $this->shippingGroup;
    }

    public function getShippingMethod(): ?string
    {
        return $this->shippingMethod;
    }

    public function getShippingReturnMethod(): ?string
    {
        return $this->shippingReturnMethod;
    }
}
