<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

use Symfony\Contracts\HttpClient\ResponseInterface as HttpClientResponseInterface;
use Wundii\AfterbuySdk\Dto\ResponseError;
use Wundii\AfterbuySdk\Dto\ResponseWarning;
use Wundii\AfterbuySdk\Enum\CallStatusEnum;
use Wundii\AfterbuySdk\Enum\EndpointEnum;
use Wundii\DataMapper\DataMapper;

/**
 * @template T of object
 */
interface ResponseInterface
{
    /**
     * @param DataMapper<T> $dataMapper
     */
    public function __construct(DataMapper $dataMapper, HttpClientResponseInterface $httpClientResponse, EndpointEnum $endpointEnum);

    public function getCallStatus(): CallStatusEnum;

    public function getEndpoint(): EndpointEnum;

    /**
     * @return ResponseError[]
     */
    public function getErrorMessages(): array;

    public function getInfo(): mixed;

    public function getResult(): ?ResponseDtoInterface;

    public function getStatusCode(): int;

    public function getVersionId(): int;

    /**
     * @return ResponseWarning[]
     */
    public function getWarningMessages(): array;

    public function getXmlResponse(): string;
}
