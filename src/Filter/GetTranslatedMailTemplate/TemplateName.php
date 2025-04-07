<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetTranslatedMailTemplate;

use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetTranslatedMailTemplateFilterInterface;

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
