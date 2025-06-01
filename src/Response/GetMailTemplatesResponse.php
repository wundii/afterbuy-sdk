<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetMailTemplates\MailTemplates;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<MailTemplates>
 */
final class GetMailTemplatesResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return MailTemplates
     */
    public function getResult(): ResponseDtoInterface
    {
        return $this->dataMapper->xml($this->content, MailTemplates::class, ['Result'], true);
    }
}
