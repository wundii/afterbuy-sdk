<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use Wundii\AfterbuySdk\Dto\CreateSoldItems\Order;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Interface\RequestInterface;
use Wundii\AfterbuySdk\Response\CreateSoldItemsResponse;

final readonly class CreateSoldItemsRequest implements RequestInterface
{
    public function __construct(
        private Order $order,
    ) {
    }

    public function callName(): string
    {
        return 'CreateSoldItems';
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): null
    {
        return null;
    }

    public function requestDto(): RequestDtoArrayInterface
    {
        return $this->order;
    }

    public function responseClass(): string
    {
        return CreateSoldItemsResponse::class;
    }

    public function uri(EndpointEnum $endpointEnum): string
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
