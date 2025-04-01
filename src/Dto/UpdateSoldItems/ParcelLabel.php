<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final readonly class ParcelLabel implements AfterbuyDtoInterface
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
