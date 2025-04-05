<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use InvalidArgumentException;

final readonly class AdditionalDescriptionField implements AfterbuyAppendXmlContentInterface
{
    public function __construct(
        private ?int $fieldIdIdent = null,
        private ?string $fieldNameIdent = null,
        private ?string $fieldName = null,
        private ?string $fieldLabel = null,
        private ?string $fieldContent = null,
    ) {
        if ($fieldIdIdent === null && $fieldNameIdent === null) {
            throw new InvalidArgumentException('Either fieldIdIdent or fieldNameIdent must be set.');
        }
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $additinalDescriptionField = $xml->addChild('AdditionalDescriptionField');
        $additinalDescriptionField->addNumber('FieldIDIdent', $this->fieldIdIdent);
        $additinalDescriptionField->addString('FieldNameIdent', $this->fieldNameIdent);
        $additinalDescriptionField->addString('FieldName', $this->fieldName);
        $additinalDescriptionField->addString('FieldLabel', $this->fieldLabel);
        $additinalDescriptionField->addString('FieldContent', $this->fieldContent);
    }

    public function getFieldContent(): ?string
    {
        return $this->fieldContent;
    }

    public function getFieldIdIdent(): ?int
    {
        return $this->fieldIdIdent;
    }

    public function getFieldLabel(): ?string
    {
        return $this->fieldLabel;
    }

    public function getFieldName(): ?string
    {
        return $this->fieldName;
    }

    public function getFieldNameIdent(): ?string
    {
        return $this->fieldNameIdent;
    }
}
