<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class Products implements ResponseDtoInterface
{
    /**
     * @param Product[] $products
     */
    public function __construct(
        private bool $hasMoreProducts = false,
        private ?int $lastProductId = null,
        private array $products = [],
        private ?string $shippingServicesList = null,
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
