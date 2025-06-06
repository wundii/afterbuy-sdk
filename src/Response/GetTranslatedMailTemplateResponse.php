<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Exception;
use Wundii\AfterbuySdk\Dto\GetTranslatedMailTemplate\TranslatedMailText;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<TranslatedMailText>
 */
final class GetTranslatedMailTemplateResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return ?TranslatedMailText
     */
    public function getResult(): ?ResponseDtoInterface
    {
        try {
            return $this->dataMapper->xml($this->content, TranslatedMailText::class, ['Result']);
        } catch (Exception) {
            return null;
        }
    }
}
