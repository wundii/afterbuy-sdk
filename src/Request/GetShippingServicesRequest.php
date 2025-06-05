<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\AfterbuyApiSourceEnum;
use Wundii\AfterbuySdk\Enum\AfterbuyDetailLevelEnum;
use Wundii\AfterbuySdk\Enum\AfterbuyEndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\AfterbuySdk\Interface\RequestInterface;
use Wundii\AfterbuySdk\Response\GetShippingServicesResponse;

final readonly class GetShippingServicesRequest implements RequestInterface
{
    /**
     * @param AfterbuyDetailLevelEnum[] $afterbuyDetailLevelEnum empty array === first detail level
     */
    public function __construct(
        private AfterbuyDetailLevelEnum|array $afterbuyDetailLevelEnum = AfterbuyDetailLevelEnum::FIRST,
    ) {
    }

    public function callName(): string
    {
        return 'GetShippingServices';
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): string
    {
        $afterbuyGlobal->setPayloadEnvironments(AfterbuyApiSourceEnum::XML, $this->callName());
        $afterbuyGlobal->setDetailLevelEnum($this->afterbuyDetailLevelEnum, AfterbuyDetailLevelEnum::THIRD);

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);

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
        return GetShippingServicesResponse::class;
    }

    public function url(AfterbuyEndpointEnum $afterbuyEndpointEnum): string
    {
        return $afterbuyEndpointEnum->afterbuyApiUri();
    }

    public function query(): array
    {
        return [];
    }
}
