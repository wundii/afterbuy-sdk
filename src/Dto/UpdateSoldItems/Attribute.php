<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateSoldItems;

use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class Attribute implements AfterbuyAppendXmlContentInterface
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
