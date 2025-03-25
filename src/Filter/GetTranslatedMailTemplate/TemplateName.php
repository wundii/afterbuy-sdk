<?php

declare(strict_types=1);

namespace AfterbuySdk\Filter\GetTranslatedMailTemplate;

use AfterbuySdk\Filter\FilterValue;
use AfterbuySdk\Interface\Filter\GetTranslatedMailTemplateFilterInterface;

final readonly class TemplateName implements GetTranslatedMailTemplateFilterInterface
{
    public function __construct(
        private string $templateName
    ) {
    }

    public function getFilterName(): string
    {
        return 'TemplateName';
    }

    public function getFilterValues(): array
    {
        return [
            new FilterValue($this->templateName),
        ];
    }
}
