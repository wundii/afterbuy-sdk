<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\GetPaymentServices\PaymentServices;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;

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
