<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use DateTimeInterface;

final readonly class ShippingInfo implements AfterbuyDtoInterface, AfterbuyAppendXmlContentInterface
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

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $shipplingInfo = $xml->addChild('ShippingInfo');
        $shipplingInfo->addString('ShippingMethod', $this->shippingMethod);
        $shipplingInfo->addString('ShippingReturnMethod', $this->shippingReturnMethod);
        $shipplingInfo->addString('ShippingGroup', $this->shippingGroup);
        $shipplingInfo->addNumber('ShippingCost', $this->shippingCost);
        $shipplingInfo->addDateTime('DeliveryDate', $this->deliveryDate);
        $shipplingInfo->addString('DeliveryService', $this->deliveryService);
        $shipplingInfo->addNumber('eBayShippingCost', $this->ebayShippingCost);
        $shipplingInfo->addBool('SendShippingMail', $this->sendShippingMail);

        if ($this->parcelLabels !== []) {
            $parcelLabels = $shipplingInfo->addChild('ParcelLabels');
            foreach ($this->parcelLabels as $parcelLabel) {
                $parcelLabel->appendXmlContent($parcelLabels);
            }
        }
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
