<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\PaymentServices;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\ErrorMessagesResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<PaymentServices>
 */
final class GetPaymentServicesResponse implements AfterbuyResponseInterface
{
    use ErrorMessagesResponseTrait;

    /**
     * @return PaymentServices
     */
    public function getResponse(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, PaymentServices::class);
    }

    public function getErrorMessages(): array
    {
        return [];
    }
}
