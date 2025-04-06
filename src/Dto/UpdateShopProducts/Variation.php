<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class Variation implements AfterbuyAppendXmlContentInterface
{
    /**
     * @param VariationValue[] $variationValues
     */
    public function __construct(
        private string $variationName,
        private array $variationValues,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $variation = $xml->addChild('Variation');
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
    #[Assert\Valid]
    public function getVariationValues(): array
    {
        return $this->variationValues;
    }
}
