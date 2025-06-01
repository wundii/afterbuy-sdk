<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetUserDefinedFlags\UserDefinedFlags;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<UserDefinedFlags>
 */
final class GetUserDefinedFlagsResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return UserDefinedFlags
     */
    public function getResult(): ResponseDtoInterface
    {
        return $this->dataMapper->xml($this->content, UserDefinedFlags::class, ['Result'], true);
    }
}
