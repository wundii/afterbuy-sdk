<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalog;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalogs;
use Wundii\AfterbuySdk\Enum\AfterbuyApiSourceEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionCatalogsEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\AfterbuySdk\Interface\RequestInterface;
use Wundii\AfterbuySdk\Response\UpdateCatalogsResponse;

final readonly class UpdateCatalogsRequest implements RequestInterface
{
    /**
     * @param Catalog[] $catalogs
     */
    public function __construct(
        private UpdateActionCatalogsEnum $updateActionCatalogsEnum,
        private array $catalogs = [],
    ) {
    }

    public function callName(): string
    {
        return 'UpdateCatalogs';
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
        return new Catalogs(
            $this->updateActionCatalogsEnum,
            $this->catalogs
        );
    }

    public function responseClass(): string
    {
        return UpdateCatalogsResponse::class;
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
