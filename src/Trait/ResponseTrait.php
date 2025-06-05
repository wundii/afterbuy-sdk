<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Trait;

use SimpleXMLElement;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface as HttpClientResponseInterface;
use Wundii\AfterbuySdk\Dto\ResponseError;
use Wundii\AfterbuySdk\Dto\ResponseErrorList;
use Wundii\AfterbuySdk\Dto\ResponseWarning;
use Wundii\AfterbuySdk\Dto\ResponseWarningList;
use Wundii\AfterbuySdk\Enum\AfterbuyCallStatusEnum;
use Wundii\AfterbuySdk\Enum\AfterbuyEndpointEnum;
use Wundii\DataMapper\DataMapper;

trait ResponseTrait
{
    protected string $content;

    protected ?ResponseErrorList $afterbuyErrorList = null;

    protected ?ResponseWarningList $afterbuyWarningList = null;

    protected AfterbuyCallStatusEnum $afterbuyCallStatusEnum;

    protected int $versionId;

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function __construct(
        protected DataMapper $dataMapper,
        protected HttpClientResponseInterface $httpClientResponse,
        protected AfterbuyEndpointEnum $afterbuyEndpointEnum,
    ) {
        $content = $this->httpClientResponse->getContent(false);
        $this->content = $content;

        preg_match('/<CallStatus>(.*)<\/CallStatus>/s', $content, $matches);
        $callStatus = $matches[1] ?? null;

        if ($callStatus === null) {
            preg_match('/<success>(.*)<\/success>/s', $content, $matches);
            $success = $matches[1] ?? null;
            $callStatus = match ($success) {
                '1' => 'Success',
                '0' => 'Error',
                default => null,
            };

            $content = $this->convertErrorXmlToAfterbuyFormat($content);
        }

        preg_match('/<VersionID>(.*)<\/VersionID>/s', $content, $matches);
        $this->versionId = (int) ($matches[1] ?? 0);

        $this->afterbuyCallStatusEnum = match ($callStatus) {
            'Success' => AfterbuyCallStatusEnum::SUCCESS,
            'Warning' => AfterbuyCallStatusEnum::WARNING,
            'Error' => AfterbuyCallStatusEnum::ERROR,
            default => AfterbuyCallStatusEnum::UNKNOWN,
        };

        if ($this->afterbuyCallStatusEnum === AfterbuyCallStatusEnum::ERROR) {
            /** @phpstan-ignore-next-line */
            $this->afterbuyErrorList = $this->dataMapper->xml($content, ResponseErrorList::class, ['Result'], true);
        }

        if ($this->afterbuyCallStatusEnum === AfterbuyCallStatusEnum::WARNING) {
            /** @phpstan-ignore-next-line */
            $this->afterbuyWarningList = $this->dataMapper->xml($content, ResponseWarningList::class, ['Result'], true);
        }
    }

    public function convertErrorXmlToAfterbuyFormat(string $xmlString): string
    {
        $originalXml = simplexml_load_string($xmlString);
        if (! $originalXml instanceof SimpleXMLElement) {
            return $xmlString;
        }

        if (! property_exists($originalXml, 'success') || $originalXml->success === null) {
            return $xmlString;
        }

        if (! property_exists($originalXml->errorlist, 'error') || $originalXml->errorlist->error === null) {
            return $xmlString;
        }

        $afterbuy = new SimpleXMLElement('<?xml version="1.0" encoding="iso-8859-1"?><afterbuy></afterbuy>');

        $afterbuy->addChild('success', (string) $originalXml->success);

        $result = $afterbuy->addChild('Result');
        $errorlist = $result->addChild('ErrorList');

        foreach ($originalXml->errorlist->error as $errorMessage) {
            $error = $errorlist->addChild('Error');
            $error->addChild('ErrorCode', '0');
            $error->addChild('ErrorDescription', (string) $errorMessage);
            $error->addChild('ErrorLongDescription', (string) $errorMessage);
        }

        $newXmlString = $afterbuy->asXML();

        return $newXmlString !== false ? $newXmlString : $xmlString;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function getStatusCode(): int
    {
        return $this->httpClientResponse->getStatusCode();
    }

    public function getCallStatus(): AfterbuyCallStatusEnum
    {
        return $this->afterbuyCallStatusEnum;
    }

    public function getInfo(): mixed
    {
        return $this->httpClientResponse->getInfo();
    }

    public function getVersionId(): int
    {
        return $this->versionId;
    }

    public function getEndpoint(): AfterbuyEndpointEnum
    {
        return $this->afterbuyEndpointEnum;
    }

    public function getXmlResponse(): string
    {
        return $this->content;
    }

    /**
     * @return ResponseError[]
     */
    public function getErrorMessages(): array
    {
        if (! $this->afterbuyErrorList instanceof ResponseErrorList) {
            return [];
        }

        return $this->afterbuyErrorList->getErrorList();
    }

    /**
     * @return ResponseWarning[]
     */
    public function getWarningMessages(): array
    {
        if (! $this->afterbuyWarningList instanceof ResponseWarningList) {
            return [];
        }

        return $this->afterbuyWarningList->getWarningList();
    }

    public function hasErrors(): bool
    {
        return $this->afterbuyErrorList instanceof ResponseErrorList;
    }

    public function hasWarnings(): bool
    {
        return $this->afterbuyWarningList instanceof ResponseWarningList;
    }
}
