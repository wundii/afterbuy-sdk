<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetMailTemplates;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class MailTemplate implements ResponseDtoInterface
{
    public function __construct(
        private int $templateId,
        private ?string $templateName = null,
        private ?string $templateSubject = null,
        private ?string $templateText = null,
        private bool $templateHtml = false,
    ) {
    }

    public function isTemplateHtml(): bool
    {
        return $this->templateHtml;
    }

    public function setTemplateHtml(bool $templateHtml): void
    {
        $this->templateHtml = $templateHtml;
    }

    public function getTemplateId(): int
    {
        return $this->templateId;
    }

    public function setTemplateId(int $templateId): void
    {
        $this->templateId = $templateId;
    }

    public function getTemplateName(): ?string
    {
        return $this->templateName;
    }

    public function setTemplateName(?string $templateName): void
    {
        $this->templateName = $templateName;
    }

    public function getTemplateSubject(): ?string
    {
        return $this->templateSubject;
    }

    public function setTemplateSubject(?string $templateSubject): void
    {
        $this->templateSubject = $templateSubject;
    }

    public function getTemplateText(): ?string
    {
        return $this->templateText;
    }

    public function setTemplateText(?string $templateText): void
    {
        $this->templateText = $templateText;
    }
}
