<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\OrderDirectionEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestInterface;
use Wundii\AfterbuySdk\Interface\Filter\GetSoldItemsFilterInterface;
use Wundii\AfterbuySdk\Response\GetSoldItemsResponse;

final readonly class GetSoldItemsRequest implements AfterbuyRequestInterface
{
    /**
     * @var DetailLevelEnum[]
     */
    private array $detailLevelEnums;

    /**
     * @param GetSoldItemsFilterInterface[] $filter
     */
    public function __construct(
        private array $filter = [],
        private int $maxSoldItems = 250,
        private bool $returnHiddenItems = false,
        private OrderDirectionEnum $orderDirectionEnum = OrderDirectionEnum::ASC,
        private ?bool $requestAllItems = null,
        DetailLevelEnum ...$detailLevelEnum,
    ) {
        $this->detailLevelEnums = $detailLevelEnum;
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function requestClass(): ?AfterbuyAppendXmlContentInterface
    {
        return null;
    }

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): string
    {
        $maxSoldItems = $this->maxSoldItems;
        if ($maxSoldItems > 250) {
            $maxSoldItems = 250;
        }

        $afterbuyGlobal->setCallName('GetSoldItems');
        $afterbuyGlobal->setDetailLevelEnums($this->detailLevelEnums, DetailLevelEnum::SIXTH);

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
