<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\Order;
use Wundii\AfterbuySdk\Dto\UpdateSoldItems\Orders;
use Wundii\AfterbuySdk\Enum\AfterbuyApiSourceEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\AfterbuySdk\Interface\RequestInterface;
use Wundii\AfterbuySdk\Response\UpdateSoldItemsResponse;

final readonly class UpdateSoldItemsRequest implements RequestInterface
{
    /**
     * @param Order[] $orders
     */
    public function __construct(
        private array $orders = [],
    ) {
    }

    public function callName(): string
    {
        return 'UpdateSoldItems';
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::POST;
    }

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): string
    {
        $afterbuyGlobal->setCallName($this->callName());
        $afterbuyGlobal->setAfterbuyApiSourceEnum(AfterbuyApiSourceEnum::XML);

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);
        $xml->appendContent($this->requestDto());

        $string = $xml->asXML();
        if ($string === false) {
            throw new RuntimeException('XML could not be generated');
        }

        return $string;
    }

    public function requestDto(): RequestDtoXmlInterface
    {
        return new Orders(
            $this->orders
        );
    }

    public function responseClass(): string
    {
        return UpdateSoldItemsResponse::class;
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
