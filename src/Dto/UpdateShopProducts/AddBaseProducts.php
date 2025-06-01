<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\UpdateActionAddBaseProductEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final readonly class AddBaseProducts implements RequestDtoXmlInterface
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

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $addBaseProducts = $simpleXml->addChild('AddBaseProducts');
        $addBaseProducts->addNumber('UpdateAction', $this->updateActionAddBaseProductEnum->value);
        foreach ($this->addBaseProducts as $addBaseProduct) {
            $addBaseProduct->appendXmlContent($addBaseProducts);
        }
    }

    /**
     * @return AddBaseProduct[]
     */
    #[Assert\Count(min: 1)]
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
