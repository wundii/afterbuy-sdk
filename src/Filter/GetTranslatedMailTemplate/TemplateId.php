<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetTranslatedMailTemplate;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetTranslatedMailTemplateFilterInterface;

final readonly class TemplateId implements GetTranslatedMailTemplateFilterInterface
{
    public function __construct(
        private int $templateId
    ) {
    }

    public function getFilterName(): string
    {
        return 'TemplateID';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue((string) $this->templateId),
        ];
    }
}
