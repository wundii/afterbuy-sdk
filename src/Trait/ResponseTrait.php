<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Trait;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Wundii\AfterbuySdk\Dto\ResponseError;
use Wundii\AfterbuySdk\Dto\ResponseErrorList;
use Wundii\AfterbuySdk\Dto\ResponseWarning;
use Wundii\AfterbuySdk\Dto\ResponseWarningList;
use Wundii\AfterbuySdk\Enum\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\DataMapper\DataMapper;

trait ResponseTrait
{
    protected string $content;

    protected ?ResponseErrorList $afterbuyErrorList = null;

    protected ?ResponseWarningList $afterbuyWarningList = null;

    protected CallStatusEnum $callStatus;

    protected int $versionId;

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function __construct(
        protected DataMapper $dataMapper,
        protected ResponseInterface $httpClientResponse,
        protected EndpointEnum $endpointEnum,
    ) {
        $content = $this->httpClientResponse->getContent(false);
        $this->content = $content;

        preg_match('/<CallStatus>(.*)<\/CallStatus>/s', $content, $matches);
        $callStatus = $matches[1] ?? null;

        preg_match('/<VersionID>(.*)<\/VersionID>/s', $content, $matches);
        $this->versionId = (int) $matches[1];

        $this->callStatus = match ($callStatus) {
            'Success' => CallStatusEnum::SUCCESS,
            'Warning' => CallStatusEnum::WARNING,
            'Error' => CallStatusEnum::ERROR,
            default => CallStatusEnum::UNKNOWN,
        };

        if ($this->callStatus === CallStatusEnum::ERROR) {
            /** @phpstan-ignore-next-line */
            $this->afterbuyErrorList = $this->dataMapper->xml($content, ResponseErrorList::class, ['Result'], true);
        }

        if ($this->callStatus === CallStatusEnum::WARNING) {
            /** @phpstan-ignore-next-line */
            $this->afterbuyWarningList = $this->dataMapper->xml($content, ResponseWarningList::class, ['Result'], true);
        }
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function getStatusCode(): int
    {
        return $this->httpClientResponse->getStatusCode();
    }

    public function getCallStatus(): CallStatusEnum
    {
        return $this->callStatus;
    }

    public function getInfo(): mixed
    {
        return $this->httpClientResponse->getInfo();
    }

    public function getVersionId(): int
    {
        return $this->versionId;
    }

    public function getEndpoint(): EndpointEnum
    {
        return $this->endpointEnum;
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
