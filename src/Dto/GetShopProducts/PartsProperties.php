<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

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
