<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetPaymentServices;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class PaymentServices implements AfterbuyDtoInterface
{
    /**
     * @param PaymentService[] $paymentService
     */
    public function __construct(
        private array $paymentService,
    ) {
    }

    /**
     * @return PaymentService[]
     */
    public function getPaymentService(): array
    {
        return $this->paymentService;
    }

    public function setPaymentService(?PaymentService $paymentService): void
    {
        if (! $paymentService instanceof PaymentService) {
            return;
        }

        $this->paymentService[] = $paymentService;
    }
}
