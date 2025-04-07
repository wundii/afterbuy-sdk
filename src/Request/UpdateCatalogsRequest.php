<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Dto\AfterbuyGlobal;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalog;
use Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalogs;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Enum\UpdateActionCatalogsEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestInterface;
use Wundii\AfterbuySdk\Response\UpdateCatalogsResponse;

final readonly class UpdateCatalogsRequest implements AfterbuyRequestInterface
{
    /**
     * @param Catalog[] $catalogs
     */
    public function __construct(
        private UpdateActionCatalogsEnum $updateActionCatalogsEnum,
        private array $catalogs = [],
    ) {
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::POST;
    }

    public function requestClass(): AfterbuyAppendXmlContentInterface
    {
        return new Catalogs(
            $this->updateActionCatalogsEnum,
            $this->catalogs
        );
    }

    public function payload(AfterbuyGlobal $afterbuyGlobal): string
    {
        $afterbuyGlobal->setCallName('UpdateCatalogs');
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
        return UpdateCatalogsResponse::class;
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
