<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetTranslatedMailTemplate;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of payment services.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class TranslatedMailText implements ResponseDtoInterface
{
    public function __construct(
        private string $translatedMailSubject,
        private string $translatedMailText,
    ) {
    }

    public function getTranslatedMailSubject(): string
    {
        return $this->translatedMailSubject;
    }

    public function setTranslatedMailSubject(string $translatedMailSubject): void
    {
        $this->translatedMailSubject = $translatedMailSubject;
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
