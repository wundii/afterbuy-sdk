<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetUserDefinedFlags\UserDefinedFlags;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyResponseInterface;
use Wundii\AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<UserDefinedFlags>
 */
final class GetUserDefinedFlagsResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return UserDefinedFlags
     */
    public function getResult(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, UserDefinedFlags::class, ['Result'], true);
    }
}
