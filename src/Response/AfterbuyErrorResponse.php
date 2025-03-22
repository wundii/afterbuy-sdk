<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\AfterbuyError;
use AfterbuySdk\Dto\AfterbuyErrorList;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\ErrorMessagesResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<AfterbuyErrorList>
 */
final class AfterbuyErrorResponse implements AfterbuyResponseInterface
{
    use ErrorMessagesResponseTrait;

    /**
     * @return AfterbuyErrorList
     */
    public function getResponse(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, AfterbuyErrorList::class, ['Result']);
    }

    /**
     * @return AfterbuyError[]
     */
    public function getErrorMessages(): array
    {
        return $this->getResponse()->getErrorList();
    }
}
