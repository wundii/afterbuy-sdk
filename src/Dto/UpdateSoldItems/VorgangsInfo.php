<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final readonly class VorgangsInfo implements AfterbuyDtoInterface
{
    public function __construct(
        private ?string $VorgangsInfo1 = null,
        private ?string $VorgangsInfo2 = null,
        private ?string $VorgangsInfo3 = null,
    ) {
    }

    public function getVorgangsInfo1(): ?string
    {
        return $this->VorgangsInfo1;
    }

    public function getVorgangsInfo2(): ?string
    {
        return $this->VorgangsInfo2;
    }

    public function getVorgangsInfo3(): ?string
    {
        return $this->VorgangsInfo3;
    }
}
