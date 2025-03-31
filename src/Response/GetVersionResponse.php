<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\GetVersion\Versions;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;
use Exception;

/**
 * @template-implements AfterbuyResponseInterface<Versions>
 */
final class GetVersionResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return ?Versions
     */
    public function getResponse(): ?AfterbuyDtoInterface
    {
        try {
            return $this->dataMapper->xml($this->content, Versions::class, ['Result']);
        } catch (Exception) {
            return null;
        }
    }
}
