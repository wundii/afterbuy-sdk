<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\GetTranslatedMailTemplate\TranslatedMailText;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;
use Exception;

/**
 * @template-implements AfterbuyResponseInterface<TranslatedMailText>
 */
final class GetTranslatedMailTemplateResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return ?TranslatedMailText
     */
    public function getResponse(): ?AfterbuyDtoInterface
    {
        try {
            return $this->dataMapper->xml($this->content, TranslatedMailText::class, ['Result']);
        } catch (Exception) {
            return null;
        }
    }
}
