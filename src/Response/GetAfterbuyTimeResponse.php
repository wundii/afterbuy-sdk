<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Exception;
use Wundii\AfterbuySdk\Dto\GetAfterbuyTime\AfterbuyTime;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyResponseInterface;
use Wundii\AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<AfterbuyTime>
 */
final class GetAfterbuyTimeResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return ?AfterbuyTime
     */
    public function getResult(): ?AfterbuyDtoInterface
    {
        try {
            return $this->dataMapper->xml($this->content, AfterbuyTime::class, ['Result']);
        } catch (Exception) {
            return null;
        }
    }
}
