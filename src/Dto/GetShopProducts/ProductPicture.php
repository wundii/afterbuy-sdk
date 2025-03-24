<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShopProducts;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class ProductPicture implements AfterbuyDtoInterface
{
    /**
     * @param ProductPictureChild[] $childs
     */
    public function __construct(
        private int $nr,
        private int $typ,
        private string $url,
        private string $altText,
        private array $childs = [],
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

    /**
     * @return ProductPictureChild[]
     */
    public function getChilds(): array
    {
        return $this->childs;
    }

    /**
     * @param ProductPictureChild[] $childs
     */
    public function setChilds(array $childs): void
    {
        $this->childs = $childs;
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
