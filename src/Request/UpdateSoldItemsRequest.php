<?php

declare(strict_types=1);

namespace AfterbuySdk\Request;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Dto\UpdateSoldItems\Order;
use AfterbuySdk\Dto\UpdateSoldItems\Orders;
use AfterbuySdk\Enum\DetailLevelEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\RequestMethodEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use AfterbuySdk\Interface\AfterbuyRequestInterface;
use AfterbuySdk\Response\UpdateSoldItemsResponse;
use RuntimeException;

final readonly class UpdateSoldItemsRequest implements AfterbuyRequestInterface
{
    /**
     * @param Order[] $orders
     */
    public function __construct(
        private array $orders = [],
    ) {
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::POST;
    }

    public function requestClass(): AfterbuyAppendXmlContentInterface
    {
        $orders = new Orders(
            $this->orders
        );

        if ($orders->isValid() === false) {
            throw new RuntimeException($orders->getInvalidMessage());
        }

        return $orders;
    }

    public function payload(AfterbuyGlobal $afterbuyGlobal): string
    {
        $afterbuyGlobal->setCallName('UpdateSoldItems');
        $afterbuyGlobal->setDetailLevelEnum(DetailLevelEnum::FIRST);

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);
        $xml->appendContent($this->requestClass());

        $string = $xml->asXML();
        if ($string === false) {
            throw new RuntimeException('XML could not be generated');
        }

        return $string;
    }

    public function responseClass(): string
    {
        return UpdateSoldItemsResponse::class;
    }

    public function uri(EndpointEnum $endpointEnum): string
    {
        return $endpointEnum->value;
    }

    public function query(): array
    {
        return [];
    }
}
