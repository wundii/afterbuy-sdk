<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetTranslatedMailTemplate;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class TranslatedMailText implements AfterbuyDtoInterface
{
    public function __construct(
        private string $translatedMailText,
    ) {
    }

    public function getTranslatedMailText(): string
    {
        return trim($this->translatedMailText);
    }

    public function setTranslatedMailText(string $translatedMailText): void
    {
        $this->translatedMailText = $translatedMailText;
    }
}
