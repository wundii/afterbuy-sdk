<?php

declare(strict_types=1);

namespace AfterbuySdk\Request;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\RequestMethodEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyRequestInterface;
use AfterbuySdk\Response\GetAfterbuyTimeResponse;
use RuntimeException;

final readonly class GetAfterbuyTimeRequest implements AfterbuyRequestInterface
{
    public function __construct(
        private AfterbuyGlobal $afterbuyGlobal,
        private int $detailLevel = 0,
    ) {
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function payload(): string
    {
        $this->afterbuyGlobal->setCallName('GetAfterbuyTime');
        $this->afterbuyGlobal->setDetailLevel($this->detailLevel);

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($this->afterbuyGlobal);

        $string = $xml->asXML();

        if ($string === false) {
            throw new RuntimeException('XML could not be generated');
        }

        return $string;
    }

    public function responseClass(): string
    {
        return GetAfterbuyTimeResponse::class;
    }

    public function uri(): string
    {
        return $this->afterbuyGlobal->getEndpoint()->value;
    }

    public function query(): array
    {
        return [];
    }
}
