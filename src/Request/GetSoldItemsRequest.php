<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\AfterbuyApiSourceEnum;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\OrderDirectionEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\AfterbuySdk\Interface\RequestInterface;
use Wundii\AfterbuySdk\Response\GetSoldItemsResponse;

final readonly class GetSoldItemsRequest implements RequestInterface
{
    /**
     * @param GetSoldItemsFilterInterface[] $filter
     * @param DetailLevelEnum[] $detailLevelEnum empty array === first detail level
     */
    public function __construct(
        private array $filter = [],
        private int $maxSoldItems = 250,
        private bool $returnHiddenItems = false,
        private OrderDirectionEnum $orderDirectionEnum = OrderDirectionEnum::ASC,
        private ?bool $requestAllItems = null,
        private DetailLevelEnum|array $detailLevelEnum = DetailLevelEnum::FIRST,
    ) {
    }

    public function callName(): string
    {
        return 'GetSoldItems';
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): string
    {
        $maxSoldItems = $this->maxSoldItems;
        if ($maxSoldItems > 250) {
            $maxSoldItems = 250;
        }

        $afterbuyGlobal->setCallName($this->callName());
        $afterbuyGlobal->setAfterbuyApiSourceEnum(AfterbuyApiSourceEnum::XML);
        $afterbuyGlobal->setDetailLevelEnum($this->detailLevelEnum, DetailLevelEnum::SIXTH);

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);
        $xml->addBool('RequestAllItems', $this->requestAllItems);
        $xml->addNumber('MaxSoldItems', $maxSoldItems);
        $xml->addNumber('OrderDirection', $this->orderDirectionEnum->value);
        $xml->addBool('ReturnHiddenItems', $this->returnHiddenItems);
        $xml->addFilter($this->filter);

        $string = $xml->asXML();
        if ($string === false) {
            throw new RuntimeException('XML could not be generated');
        }

        return $string;
    }

    public function requestDto(): ?RequestDtoXmlInterface
    {
        return null;
    }

    public function responseClass(): string
    {
        return GetSoldItemsResponse::class;
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
