<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Enum\UpdateActionSkusEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;

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
    #[Assert\Count(min: 1, max: 10)]
    #[Assert\All(
        new Assert\Type('string'),
    )]
    public function getSkus(): array
    {
        return $this->skus;
    }

    public function getUpdateAction(): UpdateActionSkusEnum
    {
        return $this->updateActionSkusEnum;
    }
}
