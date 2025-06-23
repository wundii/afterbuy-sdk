<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetMailTemplates;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Hold a list of mail templates.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class MailTemplates implements ResponseDtoInterface
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
