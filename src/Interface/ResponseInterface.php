<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

use Symfony\Contracts\HttpClient\ResponseInterface as HttpClientResponseInterface;
use Wundii\AfterbuySdk\Dto\ResponseError;
use Wundii\AfterbuySdk\Dto\ResponseWarning;
use Wundii\AfterbuySdk\Enum\AfterbuyCallStatusEnum;
use Wundii\AfterbuySdk\Enum\AfterbuyEndpointEnum;
use Wundii\DataMapper\DataMapper;

/**
 * @template T of object
 */
interface ResponseInterface
{
    /**
     * @param DataMapper<T> $dataMapper
     */
    public function __construct(DataMapper $dataMapper, HttpClientResponseInterface $httpClientResponse, AfterbuyEndpointEnum $afterbuyEndpointEnum);

    public function getCallStatus(): AfterbuyCallStatusEnum;

    public function getEndpoint(): AfterbuyEndpointEnum;

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
