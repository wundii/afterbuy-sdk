<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Exception;
use Wundii\AfterbuySdk\Dto\GetVersion\Versions;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyResponseInterface;
use Wundii\AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<Versions>
 */
final class GetVersionResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return ?Versions
     */
    public function getResult(): ?AfterbuyDtoInterface
    {
        try {
            return $this->dataMapper->xml($this->content, Versions::class, ['Result']);
        } catch (Exception) {
            return null;
        }
    }
}
