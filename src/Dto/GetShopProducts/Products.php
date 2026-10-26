<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Description;
use Wundii\Structron\Attribute\Structron;

#[Structron('Holds a list of shop products.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class Products implements ResponseDtoInterface
{
    /**
     * @param Product[] $products
     */
    public function __construct(
        private bool $hasMoreProducts = false,
        #[Description('Numerically highest ProductID in this response (not the last row); use it as start value for the next request')]
        private ?int $lastProductId = null,
        private array $products = [],
        private ?string $shippingServicesList = null,
        #[Description('Only returned if PaginationEnabled is set in the request')]
        private ?PaginationResult $paginationResult = null,
    ) {
    }

    public function hasMoreProducts(): bool
    {
        return $this->hasMoreProducts;
    }

    public function setHasMoreProducts(bool $hasMoreProducts): void
    {
        $this->hasMoreProducts = $hasMoreProducts;
    }

    public function getLastProductId(): ?int
    {
        return $this->lastProductId;
    }

    public function setLastProductId(?int $lastProductId): void
    {
        $this->lastProductId = $lastProductId;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    public function getShippingServicesList(): ?string
    {
        return $this->shippingServicesList;
    }

    public function setShippingServicesList(?string $shippingServicesList): void
    {
        $this->shippingServicesList = $shippingServicesList;
    }

    public function getPaginationResult(): ?PaginationResult
    {
        return $this->paginationResult;
    }

    public function setPaginationResult(?PaginationResult $paginationResult): void
    {
        $this->paginationResult = $paginationResult;
    }
}
