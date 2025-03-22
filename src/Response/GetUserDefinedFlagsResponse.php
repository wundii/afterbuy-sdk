<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\UserDefinedFlags;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\ErrorMessagesResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<UserDefinedFlags>
 */
final class GetUserDefinedFlagsResponse implements AfterbuyResponseInterface
{
    use ErrorMessagesResponseTrait;

    /**
     * @return UserDefinedFlags
     */
    public function getResponse(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, UserDefinedFlags::class, ['Result']);
    }

    public function getErrorMessages(): array
    {
        return [];
    }
}
