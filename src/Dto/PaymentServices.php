<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class PaymentServices implements AfterbuyDtoInterface
{
    /**
     * @param PaymentService[] $result
     */
    public function __construct(
        private array $result,
    ) {
    }

    /**
     * @return PaymentService[]
     */
    public function getResult(): array
    {
        return $this->result;
    }

    /**
     * @param PaymentService[] $result
     */
    public function setResult(array $result): void
    {
        $this->result = $result;
    }
}
