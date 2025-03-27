<?php

declare(strict_types=1);

namespace AfterbuySdk\Request;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\DetailLevelEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\OrderDirectionEnum;
use AfterbuySdk\Enum\RequestMethodEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyRequestInterface;
use AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;
use AfterbuySdk\Response\GetSoldItemsResponse;
use RuntimeException;

final readonly class GetSoldItemsRequest implements AfterbuyRequestInterface
{
    /**
     * @param GetSoldItemsFilterInterface[] $filter
     */
    public function __construct(
        private DetailLevelEnum $detailLevelEnum = DetailLevelEnum::FIRST,
        private ?bool $requestAllItems = null,
        private int $maxSoldItems = 250,
        private OrderDirectionEnum $orderDirectionEnum = OrderDirectionEnum::ASC,
        private bool $returnHiddenItems = false,
        private array $filter = [],
    ) {
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function payload(AfterbuyGlobal $afterbuyGlobal): string
    {
        $detailLevelEnum = match ($this->detailLevelEnum) {
            DetailLevelEnum::FIRST,
            DetailLevelEnum::SECOND,
            DetailLevelEnum::THIRD,
            DetailLevelEnum::FOURTH,
            DetailLevelEnum::FIFTH,
            DetailLevelEnum::SIXTH => $this->detailLevelEnum,
            default => DetailLevelEnum::FIRST,
        };

        $maxSoldItems = $this->maxSoldItems;
        if ($maxSoldItems > 250) {
            $maxSoldItems = 250;
        }

        $afterbuyGlobal->setCallName('GetSoldItems');
        $afterbuyGlobal->setDetailLevelEnum($detailLevelEnum);

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

    public function responseClass(): string
    {
        return GetSoldItemsResponse::class;
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
