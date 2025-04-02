<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use AfterbuySdk\Interface\AfterbuyDtoInterface;

final readonly class Attribute implements AfterbuyDtoInterface, AfterbuyAppendXmlContentInterface
{
    public function __construct(
        private string $name,
        private string $value,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $attribute = $xml->addChild('Attribute');
        $attribute->addString('Name', $this->name);
        $attribute->addString('Value', $this->value);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
