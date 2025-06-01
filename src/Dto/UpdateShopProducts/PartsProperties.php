<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final readonly class PartsProperties implements RequestDtoXmlInterface
{
    /**
     * @param PartsProperty[] $partsProperties
     */
    public function __construct(
        private array $partsProperties,
    ) {
        if ($this->partsProperties === []) {
            throw new InvalidArgumentException('The partsProperties array must not be empty.');
        }
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $partsProperties = $simpleXml->addChild('PartsProperties');
        foreach ($this->partsProperties as $partProperty) {
            $partProperty->appendXmlContent($partsProperties);
        }
    }

    /**
     * @return PartsProperty[]
     */
    #[Assert\Count(min: 1)]
    #[Assert\Valid]
    public function getPartsProperties(): array
    {
        return $this->partsProperties;
    }
}
