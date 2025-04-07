<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Enum\PictureTypEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class ProductPictureChild implements AfterbuyAppendXmlContentInterface
{
    public function __construct(
        private PictureTypEnum $pictureTypEnum,
        private string $url,
        private string $altText,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $productPicture = $xml->addChild('ProductPicture');
        $productPicture->addNumber('Typ', $this->pictureTypEnum->value);
        $productPicture->addString('URL', $this->url);
        $productPicture->addString('AltText', $this->altText);
    }

    public function getAltText(): string
    {
        return $this->altText;
    }

    public function getTyp(): PictureTypEnum
    {
        return $this->pictureTypEnum;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
