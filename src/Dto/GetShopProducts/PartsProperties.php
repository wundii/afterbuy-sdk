<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShopProducts;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class PartsProperties implements AfterbuyDtoInterface
{
    /**
     * @param PartsProperty[] $partsProperty
     */
    public function __construct(
        private array $partsProperty,
    ) {
    }

    /**
     * @return PartsProperty[]
     */
    public function getPartsProperty(): array
    {
        return $this->partsProperty;
    }

    public function setPartsProperty(PartsProperty $partsProperty): void
    {
        $this->partsProperty[] = $partsProperty;
    }
}
