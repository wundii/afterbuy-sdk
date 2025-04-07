<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetPaymentServices\PaymentServices;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyResponseInterface;
use Wundii\AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<PaymentServices>
 */
final class GetPaymentServicesResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return PaymentServices
     */
    public function getResult(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, PaymentServices::class, ['Result'], true);
    }
}
