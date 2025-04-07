<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Enum\AttributTypEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class AddAttribut implements AfterbuyAppendXmlContentInterface
{
    public function __construct(
        private ?string $AttributName = null,
        private ?string $AttributValue = null,
        private ?AttributTypEnum $attributTypEnum = null,
        private ?int $attributePosition = null,
        private ?bool $AttributRequired = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $addAttribut = $xml->addChild('AddAttribut');
        $addAttribut->addString('AttributName', $this->AttributName);
        $addAttribut->addString('AttributValue', $this->AttributValue);
        $addAttribut->addNumber('AttributTyp', $this->attributTypEnum?->value);
        $addAttribut->addNumber('AttributPosition', $this->attributePosition);
        $addAttribut->addBool('AttributRequired', $this->AttributRequired);
    }

    public function getAttributName(): ?string
    {
        return $this->AttributName;
    }

    public function getAttributePosition(): ?int
    {
        return $this->attributePosition;
    }

    public function getAttributRequired(): ?bool
    {
        return $this->AttributRequired;
    }

    public function getAttributTyp(): ?AttributTypEnum
    {
        return $this->attributTypEnum;
    }

    public function getAttributValue(): ?string
    {
        return $this->AttributValue;
    }
}
