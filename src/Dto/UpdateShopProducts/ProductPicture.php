<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class ProductPicture implements AfterbuyAppendXmlContentInterface
{
    /**
     * @param ProductPictureChild[] $childs
     */
    public function __construct(
        private int $nr,
        private string $url,
        private string $altText,
        private array $childs = [],
    ) {
        if ($nr < 1 || $nr > 12) {
            throw new InvalidArgumentException('Picture number must be between 1 and 12.');
        }
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $productPicture = $xml->addChild('Feature');
        $productPicture->addNumber('Nr', $this->nr);
        $productPicture->addString('URL', $this->url);
        $productPicture->addString('AltText', $this->altText);
        if ($this->childs !== []) {
            $childs = $productPicture->addChild('Childs');
            foreach ($this->childs as $child) {
                $child->appendXmlContent($childs);
            }
        }
    }

    public function getAltText(): string
    {
        return $this->altText;
    }

    /**
     * @return ProductPictureChild[]
     */
    #[Assert\Valid]
    public function getChilds(): array
    {
        return $this->childs;
    }

    public function getNr(): int
    {
        return $this->nr;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
