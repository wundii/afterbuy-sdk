<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetSoldItems;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class ParcelLabel implements ResponseDtoInterface
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

    public function getPackageQuantity(): ?int
    {
        return $this->packageQuantity;
    }

    public function setPackageQuantity(?int $packageQuantity): void
    {
        $this->packageQuantity = $packageQuantity;
    }

    public function getPackageWeight(): ?float
    {
        return $this->packageWeight;
    }

    public function setPackageWeight(?float $packageWeight): void
    {
        $this->packageWeight = $packageWeight;
    }
}
