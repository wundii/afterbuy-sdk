<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\GetAfterbuyTime\AfterbuyTime;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;
use Exception;

/**
 * @template-implements AfterbuyResponseInterface<AfterbuyTime>
 */
final class GetAfterbuyTimeResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return ?AfterbuyTime
     */
    public function getResponse(): ?AfterbuyDtoInterface
    {
        try {
            return $this->dataMapper->xml($this->content, AfterbuyTime::class, ['Result']);
        } catch (Exception) {
            return null;
        }
    }
}
