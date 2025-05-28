<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Trait;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Wundii\AfterbuySdk\Dto\AfterbuyError;
use Wundii\AfterbuySdk\Dto\AfterbuyErrorList;
use Wundii\AfterbuySdk\Dto\AfterbuyWarning;
use Wundii\AfterbuySdk\Dto\AfterbuyWarningList;
use Wundii\AfterbuySdk\Enum\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\DataMapper\DataMapper;

trait AfterbuyResponseTrait
{
    protected string $content;

    protected ?AfterbuyErrorList $afterbuyErrorList = null;

    protected ?AfterbuyWarningList $afterbuyWarningList = null;

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
        protected ResponseInterface $response,
        protected EndpointEnum $endpointEnum,
    ) {
        $content = $this->response->getContent(false);
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
            $this->afterbuyErrorList = $this->dataMapper->xml($content, AfterbuyErrorList::class, ['Result'], true);
        }

        if ($this->callStatus === CallStatusEnum::WARNING) {
            /** @phpstan-ignore-next-line */
            $this->afterbuyWarningList = $this->dataMapper->xml($content, AfterbuyWarningList::class, ['Result'], true);
        }
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function getCallStatus(): CallStatusEnum
    {
        return $this->callStatus;
    }

    public function getInfo(): mixed
    {
        return $this->response->getInfo();
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
     * @return AfterbuyError[]
     */
    public function getErrorMessages(): array
    {
        if (! $this->afterbuyErrorList instanceof AfterbuyErrorList) {
            return [];
        }

        return $this->afterbuyErrorList->getErrorList();
    }

    /**
     * @return AfterbuyWarning[]
     */
    public function getWarningMessages(): array
    {
        if (! $this->afterbuyWarningList instanceof AfterbuyWarningList) {
            return [];
        }

        return $this->afterbuyWarningList->getWarningList();
    }

    public function hasErrors(): bool
    {
        return $this->afterbuyErrorList instanceof AfterbuyErrorList;
    }

    public function hasWarnings(): bool
    {
        return $this->afterbuyWarningList instanceof AfterbuyWarningList;
    }
}
