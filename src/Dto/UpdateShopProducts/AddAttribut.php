<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Enum\AttributTypEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final readonly class AddAttribut implements RequestDtoXmlInterface
{
    public function __construct(
        private ?string $attributName = null,
        private ?string $attributValue = null,
        private ?AttributTypEnum $attributTypEnum = null,
        private ?int $attributPosition = null,
        private ?bool $attributRequired = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $addAttribut = $simpleXml->addChild('AddAttribut');
        $addAttribut->addString('AttributName', $this->attributName);
        $addAttribut->addString('AttributValue', $this->attributValue);
        $addAttribut->addNumber('AttributTyp', $this->attributTypEnum?->value);
        $addAttribut->addNumber('AttributPosition', $this->attributPosition);
        $addAttribut->addBool('AttributRequired', $this->attributRequired);
    }

    public function getAttributName(): ?string
    {
        return $this->attributName;
    }

    public function getAttributPosition(): ?int
    {
        return $this->attributPosition;
    }

    public function getAttributRequired(): ?bool
    {
        return $this->attributRequired;
    }

    public function getAttributTyp(): ?AttributTypEnum
    {
        return $this->attributTypEnum;
    }

    public function getAttributValue(): ?string
    {
        return $this->attributValue;
    }
}
