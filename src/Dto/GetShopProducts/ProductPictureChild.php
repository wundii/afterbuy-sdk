<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ProductPictureChild implements AfterbuyDtoInterface
{
    public function __construct(
        private int $nr,
        private int $typ,
        private string $url,
        private string $altText,
    ) {
    }

    public function getAltText(): string
    {
        return $this->altText;
    }

    public function setAltText(string $altText): void
    {
        $this->altText = $altText;
    }

    public function getNr(): int
    {
        return $this->nr;
    }

    public function setNr(int $nr): void
    {
        $this->nr = $nr;
    }

    public function getTyp(): int
    {
        return $this->typ;
    }

    public function setTyp(int $typ): void
    {
        $this->typ = $typ;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
