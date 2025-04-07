<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class AdditionalDescriptionField implements AfterbuyDtoInterface
{
    public function __construct(
        private int $fieldId,
        private string $fieldName,
        private string $fieldLabel,
        private string $fieldContent,
    ) {
    }

    public function getFieldContent(): string
    {
        return $this->fieldContent;
    }

    public function setFieldContent(string $fieldContent): void
    {
        $this->fieldContent = $fieldContent;
    }

    public function getFieldId(): int
    {
        return $this->fieldId;
    }

    public function setFieldId(int $fieldId): void
    {
        $this->fieldId = $fieldId;
    }

    public function getFieldLabel(): string
    {
        return $this->fieldLabel;
    }

    public function setFieldLabel(string $fieldLabel): void
    {
        $this->fieldLabel = $fieldLabel;
    }

    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    public function setFieldName(string $fieldName): void
    {
        $this->fieldName = $fieldName;
    }
}
