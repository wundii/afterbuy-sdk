<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\AfterbuyWarning;
use AfterbuySdk\Dto\AfterbuyWarningList;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<AfterbuyWarningList>
 */
final class AfterbuyWarningResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return AfterbuyWarningList
     */
    public function getResponse(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, AfterbuyWarningList::class, ['Result']);
    }

    /**
     * @return AfterbuyWarning[]
     */
    public function getErrorMessages(): array
    {
        return $this->getResponse()->getWarningList();
    }
}
