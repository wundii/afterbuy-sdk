<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final readonly class Variation implements RequestDtoXmlInterface
{
    /**
     * @param VariationValue[] $variationValues
     */
    public function __construct(
        private string $variationName,
        private array $variationValues,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $variation = $simpleXml->addChild('Variation');
        $variation->addString('VariationName', $this->variationName);
        foreach ($this->variationValues as $variationValue) {
            $variationValue->appendXmlContent($variation);
        }
    }

    public function getVariationName(): string
    {
        return $this->variationName;
    }

    /**
     * @return VariationValue[]
     */
    #[Assert\Count(min: 1)]
    #[Assert\Valid]
    public function getVariationValues(): array
    {
        return $this->variationValues;
    }
}
