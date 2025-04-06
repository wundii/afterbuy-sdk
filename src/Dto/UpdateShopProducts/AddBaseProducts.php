<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Enum\UpdateActionAddBaseProductEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class AddBaseProducts implements AfterbuyAppendXmlContentInterface
{
    /**
     * @param AddBaseProduct[] $addBaseProducts
     */
    public function __construct(
        private UpdateActionAddBaseProductEnum $updateActionAddBaseProductEnum,
        private array $addBaseProducts,
    ) {
        if ($this->addBaseProducts === []) {
            throw new InvalidArgumentException('The addCatalog array must not be empty.');
        }
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $addBaseProducts = $xml->addChild('AddBaseProducts');
        $addBaseProducts->addNumber('UpdateAction', $this->updateActionAddBaseProductEnum->value);
        foreach ($this->addBaseProducts as $addBaseProduct) {
            $addBaseProduct->appendXmlContent($addBaseProducts);
        }
    }

    /**
     * @return AddBaseProduct[]
     */
    #[Assert\Valid]
    public function getAddBaseProducts(): array
    {
        return $this->addBaseProducts;
    }

    public function getUpdateAction(): UpdateActionAddBaseProductEnum
    {
        return $this->updateActionAddBaseProductEnum;
    }
}
