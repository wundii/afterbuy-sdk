<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetSoldItems;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class PayoutId implements AfterbuyDtoInterface
{
    public function __construct(
        private ?string $payoutId = null,
        private ?string $platformSpecificOrderId = null,
    ) {
    }

    public function getPayoutId(): ?string
    {
        return $this->payoutId;
    }

    public function setPayoutId(?string $payoutId): void
    {
        $this->payoutId = $payoutId;
    }

    public function getPlatformSpecificOrderId(): ?string
    {
        return $this->platformSpecificOrderId;
    }

    public function setPlatformSpecificOrderId(?string $platformSpecificOrderId): void
    {
        $this->platformSpecificOrderId = $platformSpecificOrderId;
    }
}
