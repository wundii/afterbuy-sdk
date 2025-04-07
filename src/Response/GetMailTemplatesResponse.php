<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetMailTemplates\MailTemplates;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyResponseInterface;
use Wundii\AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<MailTemplates>
 */
final class GetMailTemplatesResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return MailTemplates
     */
    public function getResult(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, MailTemplates::class, ['Result'], true);
    }
}
