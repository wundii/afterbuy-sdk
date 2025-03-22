<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\Versions;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\ErrorMessagesResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<Versions>
 */
final class GetVersionResponse implements AfterbuyResponseInterface
{
    use ErrorMessagesResponseTrait;

    /**
     * @return Versions
     */
    public function getResponse(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, Versions::class, ['Result']);
    }

    public function getErrorMessages(): array
    {
        return [];
    }
}
