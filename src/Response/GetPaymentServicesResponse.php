<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetPaymentServices\PaymentServices;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<PaymentServices>
 */
final class GetPaymentServicesResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return PaymentServices
     */
    public function getResult(): ResponseDtoInterface
    {
        return $this->dataMapper->xml($this->content, PaymentServices::class, ['Result'], true);
    }
}
