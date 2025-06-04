<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetVersion\Versions;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<Versions>
 */
final class GetVersionResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return Versions
     */
    public function getResult(): ResponseDtoInterface
    {
        return $this->dataMapper->xml($this->content, Versions::class, ['Result']);
    }
}
