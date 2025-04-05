<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Enum\UpdateActionSkusEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use InvalidArgumentException;

final readonly class Skus implements AfterbuyAppendXmlContentInterface
{
    /**
     * @param string[] $skus
     */
    public function __construct(
        private UpdateActionSkusEnum $updateActionSkusEnum,
        private array $skus,
    ) {
        if ($this->skus === []) {
            throw new InvalidArgumentException('The SKU array must not be empty.');
        }
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $skus = $xml->addChild('Skus');
        $skus->addNumber('UpdateAction', $this->updateActionSkusEnum->value);
        foreach ($this->skus as $sku) {
            $skus->addString('Sku', $sku);
        }
    }

    /**
     * @return string[]
     */
    public function getSkus(): array
    {
        return $this->skus;
    }

    public function getUpdateAction(): UpdateActionSkusEnum
    {
        return $this->updateActionSkusEnum;
    }
}
