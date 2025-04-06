<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class PartsProperties implements AfterbuyAppendXmlContentInterface
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

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $partsProperties = $xml->addChild('PartsProperties');
        foreach ($this->partsProperties as $partProperty) {
            $partProperty->appendXmlContent($partsProperties);
        }
    }

    /**
     * @return PartsProperty[]
     */
    #[Assert\Valid]
    public function getPartsProperties(): array
    {
        return $this->partsProperties;
    }
}
