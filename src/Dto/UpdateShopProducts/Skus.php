<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\UpdateActionSkusEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestDtoXmlInterface;

final readonly class Skus implements AfterbuyRequestDtoXmlInterface
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
    #[Assert\Count(min: 1, max: 10)]
    #[Assert\All(new Assert\Type('string'))]
    public function getSkus(): array
    {
        return $this->skus;
    }

    public function getUpdateAction(): UpdateActionSkusEnum
    {
        return $this->updateActionSkusEnum;
    }
}
