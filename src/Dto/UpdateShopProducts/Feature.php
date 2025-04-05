<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class Feature implements AfterbuyAppendXmlContentInterface
{
    public function __construct(
        private int $id,
        private string $value,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $feature = $xml->addChild('Feature');
        $feature->addNumber('ID', $this->id);
        $feature->addString('Value', $this->value);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
