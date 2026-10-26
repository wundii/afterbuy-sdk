<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateSoldItems;

use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\Structron\Attribute\Description;

final readonly class ParcelLabel implements RequestDtoXmlInterface
{
    public function __construct(
        private int $itemId,
        #[Description('Package number 1-15; the numbers must form a consecutive sequence across all items of the order')]
        private int $packageNumber,
        #[Description('Tracking number of the package; an existing number is deleted if this is empty or null')]
        private ?string $parcelLabelNumber = null,
        #[Description('Return label number of the package; an existing number is deleted if this is empty or null')]
        private ?string $returnLabelNumber = null,
        private ?int $packageQuantity = null,
        private ?float $packageWeight = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $parcelLabel = $simpleXml->addChild('ParcelLabel');
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
