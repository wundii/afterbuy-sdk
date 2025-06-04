<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetAfterbuyTime\AfterbuyTime;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<AfterbuyTime>
 */
final class GetAfterbuyTimeResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return AfterbuyTime
     */
    public function getResult(): ResponseDtoInterface
    {
        return $this->dataMapper->xml($this->content, AfterbuyTime::class, ['Result']);
    }
}
