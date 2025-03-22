<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\AfterbuyTime;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<AfterbuyTime>
 */
final class GetAfterbuyTimeResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return AfterbuyTime
     */
    public function getResponse(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, AfterbuyTime::class, ['Result']);
    }

    public function getErrorMessages(): array
    {
        return [];
    }
}
