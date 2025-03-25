<?php

declare(strict_types=1);

namespace AfterbuySdk\Request;

use AfterbuySdk\Dto\AfterbuyGlobal;
use AfterbuySdk\Enum\DetailLevelEnum;
use AfterbuySdk\Enum\EndpointEnum;
use AfterbuySdk\Enum\RequestMethodEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyRequestInterface;
use AfterbuySdk\Interface\Filter\GetTranslatedMailTemplateFilterInterface;
use AfterbuySdk\Response\GetTranslatedMailTemplateResponse;
use RuntimeException;

final readonly class GetTranslatedMailTemplateRequest implements AfterbuyRequestInterface
{
    /**
     * @param GetTranslatedMailTemplateFilterInterface[] $filter
     */
    public function __construct(
        private int $offerId,
        private ?bool $useTemplate = null,
        private ?string $templateText = null,
        private array $filter = [],
    ) {
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function payload(AfterbuyGlobal $afterbuyGlobal): string
    {
        $afterbuyGlobal->setCallName('GetTranslatedMailTemplate');
        $afterbuyGlobal->setDetailLevelEnum(DetailLevelEnum::FIRST);

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);
        $xml->addNumber('OfferID', $this->offerId);
        $xml->addBool('UseTemplate', $this->useTemplate);
        $xml->addString('TemplateText', $this->templateText);
        $xml->addFilter($this->filter);

        $string = $xml->asXML();
        if ($string === false) {
            throw new RuntimeException('XML could not be generated');
        }

        return $string;
    }

    public function responseClass(): string
    {
        return GetTranslatedMailTemplateResponse::class;
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
