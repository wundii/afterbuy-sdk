<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Filter\GetTranslatedMailTemplate;

use Wundii\AfterbuySdk\Filter\FilterValue;
use Wundii\AfterbuySdk\Interface\Filter\GetTranslatedMailTemplateFilterInterface;

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
