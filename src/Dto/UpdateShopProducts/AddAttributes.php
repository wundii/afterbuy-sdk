<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\UpdateActionAttributesEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestDtoXmlInterface;

final readonly class AddAttributes implements AfterbuyRequestDtoXmlInterface
{
    /**
     * @param AddAttribut[] $addAttributes
     */
    public function __construct(
        private UpdateActionAttributesEnum $updateActionAttributesEnum,
        private array $addAttributes,
    ) {
        if ($this->addAttributes === []) {
            throw new InvalidArgumentException('The addAttributes array must not be empty.');
        }
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $addAttributes = $xml->addChild('AddAttributes');
        $addAttributes->addNumber('UpdateAction', $this->updateActionAttributesEnum->value);
        foreach ($this->addAttributes as $addAttribute) {
            $addAttribute->appendXmlContent($addAttributes);
        }
    }

    /**
     * @return AddAttribut[]
     */
    #[Assert\Count(min: 1)]
    #[Assert\Valid]
    public function getAddAttributes(): array
    {
        return $this->addAttributes;
    }

    public function getUpdateAction(): UpdateActionAttributesEnum
    {
        return $this->updateActionAttributesEnum;
    }
}
