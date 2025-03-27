<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetSoldItems;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ParcelLabel implements AfterbuyDtoInterface
{
    public function __construct(
        private int $itemId,
        private int $packageNumber,
        private ?string $parcelLabelNumber = null,
        private ?string $returnLabelNumber = null,
    ) {
    }

    public function getItemId(): int
    {
        return $this->itemId;
    }

    public function setItemId(int $itemId): void
    {
        $this->itemId = $itemId;
    }

    public function getPackageNumber(): int
    {
        return $this->packageNumber;
    }

    public function setPackageNumber(int $packageNumber): void
    {
        $this->packageNumber = $packageNumber;
    }

    public function getParcelLabelNumber(): ?string
    {
        return $this->parcelLabelNumber;
    }

    public function setParcelLabelNumber(?string $parcelLabelNumber): void
    {
        $this->parcelLabelNumber = $parcelLabelNumber;
    }

    public function getReturnLabelNumber(): ?string
    {
        return $this->returnLabelNumber;
    }

    public function setReturnLabelNumber(?string $returnLabelNumber): void
    {
        $this->returnLabelNumber = $returnLabelNumber;
    }
}
