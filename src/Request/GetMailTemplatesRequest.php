<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Request;

use RuntimeException;
use Wundii\AfterbuySdk\Core\AfterbuyGlobal;
use Wundii\AfterbuySdk\Enum\DetailLevelEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\AfterbuySdk\Enum\RequestMethodEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyGlobalInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestInterface;
use Wundii\AfterbuySdk\Response\GetMailTemplatesResponse;

final readonly class GetMailTemplatesRequest implements AfterbuyRequestInterface
{
    /**
     * @param DetailLevelEnum[] $detailLevelEnum empty array === first detail level
     */
    public function __construct(
        private ?int $templateId = null,
        private DetailLevelEnum|array $detailLevelEnum = DetailLevelEnum::FIRST,
    ) {
    }

    public function method(): RequestMethodEnum
    {
        return RequestMethodEnum::GET;
    }

    public function callName(): string
    {
        return 'GetMailTemplates';
    }

    public function requestClass(): ?AfterbuyAppendXmlContentInterface
    {
        return null;
    }

    public function payload(AfterbuyGlobalInterface $afterbuyGlobal): string
    {
        $afterbuyGlobal->setCallName($this->callName());
        $afterbuyGlobal->setDetailLevelEnum($this->detailLevelEnum, DetailLevelEnum::SECOND);

        $xml = new SimpleXMLExtend(AfterbuyGlobal::DefaultXmlRoot);
        $xml->addAfterbuyGlobal($afterbuyGlobal);
        $xml->addNumber('TemplateID', $this->templateId);

        $string = $xml->asXML();
        if ($string === false) {
            throw new RuntimeException('XML could not be generated');
        }

        return $string;
    }

    public function responseClass(): string
    {
        return GetMailTemplatesResponse::class;
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
