<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use AfterbuySdk\Interface\AfterbuyDtoInterface;

final readonly class ParcelLabel implements AfterbuyDtoInterface, AfterbuyAppendXmlContentInterface
{
    public function __construct(
        private int $itemId,
        private int $packageNumber,
        private ?string $parcelLabelNumber = null,
        private ?string $returnLabelNumber = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $parcelLabel = $xml->addChild('ParcelLabel');
        $parcelLabel->addNumber('ItemID', $this->itemId);
        $parcelLabel->addNumber('PackageNumber', $this->packageNumber);
        $parcelLabel->addString('ParcelLabelNumber', $this->parcelLabelNumber);
        $parcelLabel->addString('ReturnLabelNumber', $this->returnLabelNumber);
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
}
