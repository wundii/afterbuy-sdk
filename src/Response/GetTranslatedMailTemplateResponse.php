<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\GetTranslatedMailTemplate\TranslatedMailText;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<TranslatedMailText>
 */
final class GetTranslatedMailTemplateResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return TranslatedMailText
     */
    public function getResponse(): AfterbuyDtoInterface
    {
        return $this->dataMapper->xml($this->content, TranslatedMailText::class, ['Result']);
    }

    public function getErrorMessages(): array
    {
        return [];
    }
}
