<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class MailTemplates implements AfterbuyDtoInterface
{
    /**
     * @param MailTemplate[] $mailTemplates
     */
    public function __construct(
        private array $mailTemplates,
    ) {
    }

    /**
     * @return MailTemplate[]
     */
    public function getMailTemplates(): array
    {
        return $this->mailTemplates;
    }

    /**
     * @param MailTemplate[] $mailTemplates
     */
    public function setMailTemplates(array $mailTemplates): void
    {
        $this->mailTemplates = $mailTemplates;
    }
}
