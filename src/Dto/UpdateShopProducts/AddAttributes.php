<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Enum\UpdateActionAttributesEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class AddAttributes implements AfterbuyAppendXmlContentInterface
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
