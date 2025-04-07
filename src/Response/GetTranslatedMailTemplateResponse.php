<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Exception;
use Wundii\AfterbuySdk\Dto\GetTranslatedMailTemplate\TranslatedMailText;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyResponseInterface;
use Wundii\AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<TranslatedMailText>
 */
final class GetTranslatedMailTemplateResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return ?TranslatedMailText
     */
    public function getResult(): ?AfterbuyDtoInterface
    {
        try {
            return $this->dataMapper->xml($this->content, TranslatedMailText::class, ['Result']);
        } catch (Exception) {
            return null;
        }
    }
}
