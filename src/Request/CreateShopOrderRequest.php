<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use Wundii\AfterbuySdk\Dto\CreateShopOrder\Order;
use Wundii\AfterbuySdk\Enum\Core\ApiSourceEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Interface\RequestInterface;
use Wundii\AfterbuySdk\Response\CreateShopOrderResponse;

final readonly class CreateShopOrderRequest implements RequestInterface
{
    public function __construct(
        private Order $order,
    ) {
    }

    public function callName(): string
    {
        return 'CreateShopOrder';
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): null
    {
        $afterbuyGlobal->setPayloadEnvironments(ApiSourceEnum::SHOP, $this->callName());

        return null;
    }

    public function requestDto(): RequestDtoArrayInterface
    {
        return $this->order;
    }

    public function responseClass(): string
    {
        return CreateShopOrderResponse::class;
    }

    public function url(EndpointEnum $endpointEnum): string
    {
        return $endpointEnum->shopApiUri();
    }

    public function query(): array
    {
        return $this->order->toArray([
            'Action' => 'new',
        ]);
    }
}
