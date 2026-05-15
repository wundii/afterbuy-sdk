<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\CancelOrders\OrderCancellation;
use Wundii\AfterbuySdk\Dto\CancelOrders\OrderCancellations;
use Wundii\AfterbuySdk\Enum\Core\ApiSourceEnum;
use Wundii\AfterbuySdk\Enum\Core\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\RequestInterface;
use Wundii\AfterbuySdk\Response\CancelOrdersResponse;

final readonly class CancelOrdersRequest implements RequestInterface
{
    /**
     * @param OrderCancellation[] $orderCancellations
     */
    public function __construct(
        private array $orderCancellations = [],
    ) {
    }

    public function callName(): string
    {
        return 'CancelOrders';
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::POST;
    }

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): string
    {
        $afterbuyGlobal->setPayloadEnvironments(ApiSourceEnum::XML, $this->callName());

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);
        $xml->appendContent($this->requestDto());

        $string = $xml->asXML();
        if ($string === false) {
            throw new RuntimeException('XML could not be generated');
        }

        return $string;
    }

    public function requestDto(): OrderCancellations
    {
        return new OrderCancellations(
            $this->orderCancellations
        );
    }

    public function responseClass(): string
    {
        return CancelOrdersResponse::class;
    }

    public function url(EndpointEnum $endpointEnum): string
    {
        return $endpointEnum->afterbuyApiUri();
    }

    public function query(): array
    {
        return [];
    }
}
