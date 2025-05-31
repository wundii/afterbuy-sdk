<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateSoldItems;

use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestDtoXmlInterface;

final readonly class ParcelLabel implements AfterbuyRequestDtoXmlInterface
{
    public function __construct(
        private int $itemId,
        private int $packageNumber,
        private ?string $parcelLabelNumber = null,
        private ?string $returnLabelNumber = null,
        private ?int $packageQuantity = null,
        private ?float $packageWeight = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $parcelLabel = $xml->addChild('ParcelLabel');
        $parcelLabel->addNumber('ItemID', $this->itemId);
        $parcelLabel->addNumber('PackageNumber', $this->packageNumber);
        $parcelLabel->addString('ParcelLabelNumber', $this->parcelLabelNumber);
        $parcelLabel->addString('ReturnLabelNumber', $this->returnLabelNumber);
        $parcelLabel->addNumber('PackageQuantity', $this->packageQuantity);
        $parcelLabel->addNumber('PackageWeight', $this->packageWeight);
    }

    public function getItemId(): int
    {
        return $this->itemId;
    }

    public function getPackageNumber(): int
    {
        return $this->packageNumber;
    }

    public function getParcelLabelNumber(): ?string
    {
        return $this->parcelLabelNumber;
    }

    public function getReturnLabelNumber(): ?string
    {
        return $this->returnLabelNumber;
    }

    public function getPackageQuantity(): ?int
    {
        return $this->packageQuantity;
    }

    public function getPackageWeight(): ?float
    {
        return $this->packageWeight;
    }
}
